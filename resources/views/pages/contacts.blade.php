@extends('layouts.app')

@section('content')
    <div class="lg:px-24 lg:py-10">
        <div class="relative">
            <div class="separator hidden md:block"></div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-36 gap-y-10">
                <div>
                    @include('components.flash-message', ['name' => 'contactSuccess'])
                    @include('components.contacts.contact-form')
                </div>

                <div>
                    @include('components.flash-message', ['name' => 'appointmentSuccess'])
                    @include('components.contacts.appointment-form')
                </div>
            </div>
        </div>
    </div>
@endsection