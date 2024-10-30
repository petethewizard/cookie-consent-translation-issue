<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@if(isset($pageTitle)) {{ $pageTitle }} @else {{ 'Unknown' }} @endif - Mitkov Systems GmbH</title>

        <link rel="icon" type="image/png" href="/assets/images/common/logo.png">

        @if(strpos(Route::currentRouteName(), 'data-protection') !== false)
            <script>
                window['ga-disable-{{ config("analytics.google") }}']=true;
            </script>
        @endif

        @vite('resources/sass/app.scss')
        @cookieconsentscripts
    </head>
    <body class="antialiased lang-{{ config('app.locale') }} @if(isset($classes)){{ $classes }}@endif">
        <div id="wrapper" class="px-4 xl:px-10 overflow-x-hidden">
            <div>
                @include('components.header')
                
                <main>
                    <div id="inner" class="py-8">
                        @yield('content')
                    </div>
                </main>
            </div>
        </div>

        @include('components.scripts.common')
        
        @cookieconsentview
    </body>
</html>
