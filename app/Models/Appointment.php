<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'your_name',
        'your_email',
        'date',
        'time',
        'location',
        'ics_id',
    ];

    /**
     * Time slots available each day for appointments.
     */
    const TIME_SLOTS = [
        '09:00',
        '10:00',
        '11:00',
        '12:00',
        '13:00',
        '14:00',
        '15:00',
        '16:00',
        '17:00',
    ];
}
