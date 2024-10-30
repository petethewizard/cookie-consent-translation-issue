<div class="desktop-link {{ strpos(Route::currentRouteName(), $name) !== false ? 'active' : '' }}">
    <a href="{{ route($name) }}">
        {{ $text }}
    </a>

    @if($name === "home")
        <div class="arrow-down"></div>

        <div class="dropdown text-right">
            <a href="{{ route('electronic') }}" class="dropdown-link">
                <span class="circle"></span>
                {{ __('text.pages.electronic.title') }}
            </a>
            <a href="{{ route('microcontrollers') }}" class="dropdown-link">
                <span class="circle"></span>
                {{ __('text.pages.microcontroller.title') }}
            </a>
            <a href="{{ route('linux') }}" class="dropdown-link">
                <span class="circle"></span>
                {{ __('text.pages.linux.title') }}
            </a>
        </div>
    @endif
</div>