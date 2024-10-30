<?php

use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;

Route::post('/appointments/available-times', [AppointmentController::class, 'getAvailableTimesForDate'])->name('appointments.available-times');