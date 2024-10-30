<p>
    {{ __('text.dear') }} {{ $appointment->your_name }},
</p>

@yield('content')

<p>
    {{ __('text.yours_sincerely') }}, <br>
    {{ config('app.company_name') }}
</p>