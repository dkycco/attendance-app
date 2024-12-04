@props(['name', 'label', 'class' => null, 'placeholder' => $name, 'selected' => null])
<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
    <select name="{{ $name }}" id="{{ $name }}" {{ $attributes->merge(['class' => 'form-control ' . $class]) }} data-placeholder="{{ $placeholder }}">
        <option></option>
        {{ $slot }}
    </select>
</div>
