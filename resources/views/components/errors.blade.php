<div id="{{ $name }}-errors" class="error">
    @error($name)
        @foreach($errors->get($name) as $error)
            <div class="mt-1 text-red-700 text-sm">{{ $error }}</div>
        @endforeach
    @enderror
</div>
