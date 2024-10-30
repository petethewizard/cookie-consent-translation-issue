<nav id="mobile-nav" class="opacity-0 overflow-x-hidden overflow-y-scroll">
    <div class="header lg:h-14 flex justify-center">
        <span class="inline-block">
            <a href="{{ route('home') }}">
                <img id="logo" style="margin-bottom: 25px;" src="/assets/images/common/mobile-nav-header-2.svg" alt="Mitkov Systems GmbH">
            </a>
        </span>
    </div>

    <div class="links-wrapper">
        <div class="inner-wrapper">
            @include('components.mobile-nav-links')

            @include('components.select-language')
        </div>
    </div>

    <div id="mobile-close">
        &times;
    </div>
</nav>  