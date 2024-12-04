@props(['name', 'label', 'placeholder' => $label, 'value' => null, 'class' => null])
<div class="form-group">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <textarea placeholder="{{ $placeholder }}" name="{{ $name }}" id="{{ $name }}" {{ $attributes->merge(['class' => (!Str::contains($class, 'form-control-plaintext') ? 'form-control ' : null) . $class]) }}>{{ $value }}</textarea>
</div>
