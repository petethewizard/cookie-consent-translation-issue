<header class="lg:h-14 flex justify-between">
    <span class="inline-block">
        <a href="{{ route('home') }}">
            <img id="logo" src="/assets/images/common/logo.svg" alt="Mitkov Systems">

            <span class="divider"></span>

            <img id="next-to-logo" src="/assets/images/common/mitkov-systems-gmbh-2.svg">
        </a>
    </span>

    @include('components.nav')
</header>

@include('components.mobile-nav')