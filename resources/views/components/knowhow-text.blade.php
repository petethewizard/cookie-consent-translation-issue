<div class="grid grid-cols-1 @if(count($columns) === 2) md:grid-cols-10 @elseif(count($columns) === 3) md:grid-cols-3 @else md:grid-cols-2 xl:grid-cols-4 @endif gap-6 my-8">
    @foreach($columns as $name => $column)
        <div class="text-column @if(count($columns) === 2) md:col-span-4 @endif @if(count($columns) === 2 && $name === "first") md:col-start-2 @endif)">
            {!! $column !!}
        </div>
    @endforeach
</div>