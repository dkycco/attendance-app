@props(['size' => 'md', 'formAction' => null, 'formId' => 'form', 'title', 'photo'])
<div {{ $attributes->merge(['class' => 'modal-dialog ' . ($size !== 'fullscreen' ? 'modal-dialog-centered' : '') . ' modal-' . $size]) }}>
    <div class="modal-content border-0">
        <form action="{{ $formAction }}" id="{{ $formId }}" method="POST">
            @csrf

            @if (request()->session()->get('notification'))
            <input type="hidden" name="notification" value="{{ request()->session()->get('notification') }}">
            @endif

            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="px-1 pt-1">
                            <div class="modal-team-cover position-relative mb-0 mt-n4 mx-n4 rounded-top overflow-hidden">
                                <img src="{{ asset('images/bg-home.jpg') }}" alt="" id="cover-img" class="img-fluid">

                                <div class="d-flex position-absolute start-0 end-0 top-0 p-3">
                                    <div class="flex-grow-1">
                                        <h5 class="modal-title text-white" id="createMemberLabel">
                                            {{ $title }}
                                        </h5>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div class="d-flex gap-3 align-items-center">
                                            <button type="button" class="btn-close btn-close-white"  id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mb-4 mt-n5 pt-2">
                            <div class="position-relative d-inline-block">
                                <div class="position-absolute bottom-0 end-0">
                                    <label for="member-image-input" class="mb-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Select Member Image">
                                        <div class="avatar-xs">
                                            <div class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                                <i class="bx bx-pencil"></i>
                                            </div>
                                        </div>
                                    </label>
                                    <input class="form-control d-none" value="" id="member-image-input" type="file" accept="image/png, image/gif, image/jpeg">
                                </div>
                                <div class="avatar-lg">
                                    <div class="avatar-title bg-light rounded-circle">
                                        <img src="{{ $photo }}" id="member-img" class="avatar-md rounded-circle h-auto" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{ $slot }}
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
