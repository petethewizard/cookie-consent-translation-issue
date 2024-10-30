<div class="dots-container relative pt-8 pb-2">
    <div class="dots dots-left">
        @foreach(range(0, 12) as $n)
            @include('components.dot')
        @endforeach
    </div>
    
    <div class="dots dots-middle">
        @foreach(range(0, 480) as $n)
            @include('components.dot')
        @endforeach
    </div>

    <div class="dots dots-right">
        @foreach(range(0, 7) as $n)
            @include('components.dot')
        @endforeach    
    </div>
</div>