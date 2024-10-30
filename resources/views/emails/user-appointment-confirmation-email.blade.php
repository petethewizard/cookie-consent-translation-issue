@extends('emails.layouts.email')

@section('content')
    <p>
        {{ __('text.you_have_booked_an_appointment', ['date' => $appointment->date, 'time' => $appointment->time]) }}
    </p>

    <p>
        {{ __('text.location') }}:

        @if($appointment->location === "office")
            {{ config('app.address') }}
        @else
            {{ __('text.online_meeting_email_explanation')}}
        @endif
    </p>

    <p>{{ __('text.calendar_file_attached') }}</p>
@endsection