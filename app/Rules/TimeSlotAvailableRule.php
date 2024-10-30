<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Appointment;

class TimeSlotAvailableRule implements ValidationRule
{
    public function __construct(public ?string $date) {}

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $appointmentTaken = Appointment::where('date', $this->date)
            ->where('time', $value)
            ->first();

        if ($appointmentTaken) {
            $fail(__('validation.time_slot_not_available'));
        }
    }
}
