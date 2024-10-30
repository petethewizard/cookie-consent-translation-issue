<div id="apppointment-form">
    <h1>{{ __('text.forms.appointment.title') }}</h1>

    <form action="{{ route('appointments.store') }}" method="post">
        @csrf

        <div id="where" class="flex mt-5">
            <div class="where active online mr-4">
                <span class="checkbox"></span>
                <span class="where-text text-xl font-light">{{ __('text.emeeting') }}</span>
            </div>
            <div class="where office">
                <span class="checkbox"></span>
                <span class="where-text text-xl font-light">{{ __('text.office_meeting') }}</span>
            </div>
        </div>
        
        @include('components.elements.input', ['name' => 'your_name', 'inputType' => 'appointment', 'icon' => 'user.svg', 'placeholder' => __('text.forms.fields.placeholders.name'), 'inputClasses' => 'r-full'])
        @include('components.elements.input', ['name' => 'your_email', 'inputType' => 'appointment', 'icon' => 'mail.svg', 'placeholder' => __('text.forms.fields.placeholders.email'), 'inputClasses' => 'r-full'])
        @include('components.elements.input', ['name' => 'date', 'inputType' => 'appointment', 'icon' => 'calendar.svg', 'placeholder' => __('text.forms.fields.placeholders.date'), 'inputClasses' => 'r-full', 'autocomplete' => 'off'])

        <span class="block my-1 text-center font-light">{{ __('text.forms.fields.placeholders.dates_and_times') }}</span>

        <input type="hidden" id="time" name="time" value="{{ old('time') ? old('time') : '' }}">
        <input type="hidden" id="location" name="location" value="{{ old('location') ?? 'online' }}">

        <div id="loading" class="text-center text-xl hidden">
            <div>
                {{ __('text.forms.fields.placeholders.loading_available_times') }}
            </div>
            <div class="loader"></div>
        </div>

        <div id="available-times" class="hidden">
            <div class="text-xl font-light text-center">{{ __('text.forms.fields.placeholders.time') }}</div>

            <div id="times" class="grid grid-cols-3 gap-1">
                @foreach($times as $time)
                    <div data-time="{{ $time }}" id="time-{{ str_replace(":", "-", $time) }}" class="time border-brand border text-sm">
                        {{ $time }}

                        <div class="line"></div>
                    </div>
                @endforeach
            </div>
        </div>

        @include('components.errors', ['name' => 'time'])

        @include('components.elements.submit')
    </form>
</div>

@vite('resources/js/classes/Contacts.js')