@props(['label', 'name', 'class' => null, 'attr', 'placeholder' => $label, 'type' => 'text'])
<label class="form-label" for="{{ $name }}">{{ $label }}</label>
<div class="position-relative auth-pass-inputgroup mb-3">
    <input type="password" class="form-control pe-5 password-input" id="{{ $name }}" name="{{ $name }}" placeholder="Password">
    <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none shadow-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
</div>

<script src="{{ asset('js/pages/password-addon.init.js') }}"></script>
