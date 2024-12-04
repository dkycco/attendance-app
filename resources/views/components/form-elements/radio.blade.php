@props(['label', 'name', 'value'])
<div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="{{ $name }}" id="{{ str_replace(' ', '', $label) }}" value="{{ $value }}">
    <label class="form-check-label" for="{{ str_replace(' ', '', $label) }}">
        {{ $label }}
    </label>
</div>
