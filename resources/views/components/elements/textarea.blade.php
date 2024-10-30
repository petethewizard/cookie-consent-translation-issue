<div class="field type-contact">
    <label for="{{ $name }}">{{ __('text.forms.fields.labels.' . $name) }}</label>
    
    <div class="input-wrapper">
        <textarea id="{{ $name }}" name="{{ $name }}">{{ old($name) }}</textarea>
    </div>
</div>

@include('components.errors', ['name' => $name])