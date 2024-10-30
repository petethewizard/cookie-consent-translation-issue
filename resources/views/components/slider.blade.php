<div class="image relative">
    <div class="slider">
        @foreach($images as $image)
            <div class="slide">
                <img class="lazy" src="{{ '/assets/images/products/products/' . $image }}" />
            </div>
        @endforeach
    </div>
</div>