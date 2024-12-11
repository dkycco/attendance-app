@props(['label', 'name', 'value', 'checked' => false])
<div class="form-check">
    <input class="form-check-input" type="radio" name="{{ $name }}" id="{{ str_replace(' ', '', $label) }}" value="{{ $value }}" {{ $checked ? 'checked' : '' }}>
    <label class="form-check-label" for="{{ str_replace(' ', '', $label) }}">
        {{ $label }}
    </label>
</div>
