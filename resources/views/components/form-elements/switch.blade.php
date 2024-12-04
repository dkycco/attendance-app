@props(['label', 'name', 'class' => null, 'size' => null, 'checked' => false, 'id' => null])
<div class="form-check form-switch {{ $size ? 'form-switch-' . $size : null }}">
    <input {{ $attributes->merge(['class' => 'form-check-input ' . $class]) }} name="{{ $name }}" {{ $checked ? 'checked' : '' }} type="checkbox" role="switch" id="{{ $id ?? 'switch-' . $name }}">
    <label class="form-check-label" for="{{ $id ?? 'switch-' . $name }}">{{ $label }}</label>
</div>
