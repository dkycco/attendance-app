@props(['size' => 'md', 'formAction' => null, 'submitOnFooter' => null, 'formId' => 'form', 'title'])
<div {{ $attributes->merge(['class' => 'modal-dialog ' . ($size !== 'fullscreen' ? 'modal-dialog-centered' : '') . ' modal-' . $size]) }}>
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">{{ $title }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ $formAction }}" id="{{ $formId }}" method="POST">
            @csrf
            @if (request()->session()->get('notification'))
                <input type="hidden" name="notification" value="{{ request()->session()->get('notification') }}">
            @endif
            <div class="modal-body">
                {{ $slot }}
            </div>
            <div class="modal-footer">
                @isset($buttons)
                    {{ $buttons }}
                @endisset
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                @if ($submitOnFooter)
                    <button class="btn btn-primary" type="submit">Save</button>
                @endif
            </div>
        </form>
    </div>
</div>
