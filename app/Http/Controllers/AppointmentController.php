<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentStoreRequest;
use App\Http\Requests\DateAvailableTimesRequest;
use App\Models\Appointment;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
use App\Mail\AdminAppointmentConfirmationMail;
use App\Mail\UserAppointmentConfirmationMail;
use Illuminate\Support\Facades\Mail;
use INSAN\ICS\ICS;

class AppointmentController extends Controller
{
    const APPOINTMENT_TIMEZONE = 'Europe/Berlin';
    const APPOINTMENT_TIME_FORMAT = 'Y-m-d H:i Z';

    public function store(AppointmentStoreRequest $request) 
    {
        $input = $request->validated();

        $newAppointment = Appointment::create($input);

        $icsId = uniqid();

        $newAppointment->ics_id = $icsId;
        $newAppointment->save();

        $dateStartString = "{$newAppointment->date} {$newAppointment->time}:00";

        $dateStart = (new Carbon($dateStartString, static::APPOINTMENT_TIMEZONE))
            ->setTimezone(config('app.timezone'))
            ->toDateTimeString();

        $dateEnd = (new Carbon($dateStartString, static::APPOINTMENT_TIMEZONE))
            ->setTimezone(config('app.timezone'))
            ->addHour()
            ->toDateTimeString();

        $location = $newAppointment->location === "online" ? __('text.online_meeting') : config('app.address');

        $eventProperties = [
            'uid' => $icsId,
            'sequence' => 0,
            'description' => __('text.appointment_invitation'),
            'dtstart' => date($dateStart),
            'dtend' => date($dateEnd),
            'summary' => __('text.appointment_invitation'),
            'location' => $location,
            'url' => 'www.mitkov-systems.de',
        ];

        $icsFile = new ICS($eventProperties);
        $icsFile->setOrganizer('Martin Mitkov', 'martin@mitkov-systems.de');

        $icsString = $icsFile->toString();

        // send user confirmation email
        Mail::to($newAppointment->your_email)->send(
            (new UserAppointmentConfirmationMail($newAppointment, $icsString))
        );

        // send admin confirmation email
        Mail::to(config('mail.admin'))->send(
            (new AdminAppointmentConfirmationMail($newAppointment, $icsString))
        );

        Session::flash('appointmentSuccess', __('text.appointment_booked'));

        return back();
    }

    public function getAvailableTimesForDate(DateAvailableTimesRequest $request) 
    {
        $date = $request->date;

        $slots = Appointment::TIME_SLOTS;

        $resultingSlots = [];

        foreach ($slots as $timeSlot) {
            $appointment = Appointment::where('date', $date)
                ->where('time', $timeSlot)
                ->first();

            if ($appointment) {
                $resultingSlots[] = ['time' => $timeSlot, 'taken' => true];
            } else {
                $resultingSlots[] = ['time' => $timeSlot, 'taken' => false];
            }
        }

        return response()->json($resultingSlots);
    }
}
