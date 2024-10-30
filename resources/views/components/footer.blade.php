
<footer>
    <div class="footer-nav text-center pb-0 sm:pb-5 md:pb-0 md:flex md:justify-between">
        <a href="{{ route('contacts') }}">{{ __('text.header.nav.contacts') }}</a></a>
        <a href="{{ route('about-us') }}">{{ __('text.header.nav.about-us') }}</a></a>
        <a href="{{ route('imprint') }}">{{ __('text.header.nav.imprint') }}</a></a>
        <a href="{{ route('data-protection') }}">{{ __('text.header.nav.data-protection') }}</a></a>
        <a href="{{ route('terms') }}">{{ __('text.header.nav.terms') }}</a></a>
    </div>

    <div class="hidden sm:block">
        <div class="line-1 text-center text-sm pb-2 md:pb-0">
            <span class="desktop hidden sm:inline-block">{{ config('app.address') }} </span>
            <div class="mobile block sm:hidden text-left">
                <div class="font-bold">{{ config('app.company_name') }}</div>
                <div>{{ config('app.only_address') }}</div>
            </div>
            <span class="line">
                <span class="separator-dot">•</span>
                <span class="sm:underline name">Tel</span>: <a href="tel:{{ config('app.phone_for_dialing') }}">{{ config('app.phone') }}</a>
            </span>
            <span class="line">
                <span class="separator-dot">•</span>
                <span class="sm:underline name">E-Mail</span>: <a href="mailto:mail@mitkov-systems.de">mail@mitkov-systems.de</a>
            </span>
            <span class="line">
                <span class="separator-dot">•</span><span class="sm:underline name">{{ __('text.website') }}</span>: <a href="https://www.mitkov-systems.de">www.mitkov-systems.de</a>
            </span>
        </div>

        <div class="line-2 text-center text-sm">
            <span class="line">
                <span class="sm:underline name">{{ __('text.managing_director') }}</span>: {{ config('app.managing_director') }}
            </span>
            <span class="line">
                <span class="separator-dot">•</span> 
                <span class="sm:underline name">{{ __('text.registered') }}</span>: {{ config('app.registered') }}
            </span>
            <span class="line">
                <span class="separator-dot">•</span>
                <span class="sm:underline name">{{ __('text.tax_number') }}</span>: {{ config('app.tax_number') }}
            </span>
            <span class="line">
                <span class="separator-dot">•</span>
                <span class="sm:underline name">{{ __('text.vat_number' ) }}</span>: {{ config('app.vat_number') }}
            </span>
        </div>
    </div>
</footer>