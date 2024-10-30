<div class="relative gallery-wrapper mb-12">
    <div class="main-gallery-wrapper">
        <div class="gallery-outer">
            <div class="gallery">
                @foreach($images as $content)
                    <div class="slide">
                        @if(isset($content['type']))
                            <video class="lazy" autoplay loop width="100%" muted playsinline="" data-poster="{{ '/assets/gallery/electronic/full/' . $content['poster'] }}" type="video/mp4" data-src="{{ '/assets/gallery/electronic/full/' . $content['file'] }}" type="video/mp4">
                                <source class="lazy" data-src="{{ '/assets/gallery/electronic/full/' . $content['file'] }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @elseif($content['file'] === 'hmi-1.jpg')
                            <img src="{{ '/assets/gallery/electronic/full/' . $content['file'] }}" />
                        @else
                            <img class="lazy" data-src="{{ '/assets/gallery/electronic/full/' . $content['file'] }}" />
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        <div id="left-arrow" class="arrow left-arrow flex h-full justify-center items-center">
            <img src="/assets/icons/left-solid.svg" />
        </div>

        <div id="right-arrow" class="arrow right-arrow flex h-full justify-center items-center">
            <img src="/assets/icons/right-solid.svg" />
        </div>
    </div>

    <div class="thumbnails-wrapper lg:h-full lg:absolute top-0 right-0">
        <div id="thumbnails" class="text-center h-full">
            @foreach($images as $image)
                <div class="thumbnail w-36 h-20 inline-block cursor-pointer">
                    @if(isset($image['type']))
                        <img class="lazy w-full h-full rounded" data-src="{{ '/assets/gallery/electronic/full/' . $image['poster'] }}" />
                    @else
                        <img class="lazy w-full h-full rounded" data-src="{{ '/assets/gallery/electronic/full/' . $image['file'] }}" />
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    <img src="/assets/gallery/cornerX2-6.png" class="absolute corner"/>
</div>