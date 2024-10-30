<?php

use App\Helpers\Helper;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\CookiesConsent\ResetController;
use App\Http\Requests\NewContactRequest;
use App\Mail\NewContactMail;
use App\Models\Appointment;
use App\Models\Contact;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

Route::localized(function() {
    Route::get('/', function() {
        $pageTitle = __('text.pages.home.title');
        $classes = "homepage";

        return view('pages.home', compact('pageTitle', 'classes'));
    })->name('home');
});

Route::localized(function() {
    Route::get(Lang::uri('contacts'), function() {
        $pageTitle = __('text.pages.contacts.title');
        $classes = 'contacts-page';
        $times = Appointment::TIME_SLOTS;

        return view('pages.contacts', compact('pageTitle', 'classes', 'times'));
    })->name('contacts');
});

Route::localized(function() {
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
});

Route::localized(function() {
    Route::post('/contacts', function(NewContactRequest $request) {
        $input = $request->validated();

        if (! isset($input['message'])) {
            $input['message'] = '';
        }
    
        $contact = Contact::create($input);
    
        Mail::to(config('mail.admin'))->send(
            (new NewContactMail($contact))
        );
    
        Session::flash('contactSuccess', __('text.contact_success_msg'));
    
        return back();
    })->name('contacts.store');
});

// Cookie consent
Route::post('/cookie-consent/reset', ResetController::class)->name('cookieconsent.reset');

Route::fallback(\CodeZero\LocalizedRoutes\Controllers\FallbackController::class);
