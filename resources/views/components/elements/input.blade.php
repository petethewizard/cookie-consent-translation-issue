<div class="field type-{{ $inputType ?? 'contact' }}">
    @if(!isset($placeholder))
        <label for="{{ $name }}">
            {{ __('text.forms.fields.labels.' . $name) }} 
            <span class="required text-red-600">*</span>
        </label>
    @endif

    <div class="input-wrapper {{ $inputClasses ?? '' }}">
        <input @if(!isset($placeholder))id="{{ $name }}"@endif 
            type="@if(isset($type)){{ $type }}@else{{ 'text' }}@endif" 
            name="{{ $name }}" 
            value="{{ old($name) }}"
            placeholder="{{ $placeholder ?? '' }}"
            @if(isset($autocomplete)) autocomplete="{{ $autocomplete }}" @endif/>
    </div>

    @if(isset($placeholder))    
        <div class="icon w-5 h-5 text-center">
            <img src="/assets/icons/{{ $icon }}" class="h-7">
        </div>
    @endif
</div>

@include('components.errors', ['name' => $name])