<div class="column">
    <div class="grid grid-cols-4">
        <div class="col-span-2 sm:col-span-3 lg:hidden flex items-center mobile">
            <h2 class="title w-full text-sm sm:text-xl text-left mb-0">{{ $content['title'] }}</h2>
        </div>
        <div class="col-span-2 sm:col-span-1 lg:col-span-4 image-wrapper">
            <img src="{{ $content['image'] }}" class="max-w-full" />
        </div>

        @include('components.dots')
    </div>

    <h2 class="title hidden lg:block">{{ $content['title'] }}</h2>

    <h3 class="text-left">{{ $content['subtitle'] }}</h3>

    <p class="description">
        {!! $content['copy'] !!} <a href="{{ $content['link'] }}" class="font-light underline">{{ __('text.explore_more') }}</a>
    </p>
</div>