@if(session()->has($name))
    <div class="@if(isset($type)) error-flash @else success-flash @endif rounded-xl py-3 px-4 mb-3 border-2 outline outline-2 text-white">
        {{ session($name) }}
    </div>
@endif