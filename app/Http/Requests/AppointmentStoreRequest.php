<?php

namespace App\Http\Requests;

use App\Rules\TimeSlotAvailableRule;
use Illuminate\Foundation\Http\FormRequest;

class AppointmentStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'your_name' => 'required|max:200',
            'your_email' => 'required|email|max:200',
            'date' => 'required|date',
            'time' => ['required', 'in:09:00,10:00,11:00,12:00,13:00,14:00,15:00,16:00,17:00', new TimeSlotAvailableRule($this->date)],
            'location' => 'required|in:office,online',
        ];
    }
}
