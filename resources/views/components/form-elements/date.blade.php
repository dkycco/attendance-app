@props(['label', 'name', 'class' => null, 'placeholder' => $label, 'type' => 'date'])
<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
    <input type="{{ $type }}" {{ $attributes->merge(['class' => (!Str::contains($class, 'form-control-plaintext') ? 'form-control ' : null) . $class]) }} id="{{ $name }}" name="{{ $name }}" placeholder="{{ $placeholder }}">
</div>
