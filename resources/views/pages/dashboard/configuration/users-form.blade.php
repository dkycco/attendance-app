<x-modal-profile size="md" :title="$data->id ? 'Edit User' : 'Add New User'" :photo="$data->photo ? $data->photo : asset('images/users/multi-user.jpg')" :form-action="$url ?? route('configuration.users.store')">
    @isset($url)
    @method('put')
    @endisset

    <div class="row">
        <div class="col-12 mb-3">
            <x-form-elements.input name="name" label="Name" :value="$data->name" />
        </div>

        <div class="col-12 mb-3">
            <x-form-elements.input name="email" label="Email" type="email" :value="$data->email" />
        </div>

        <div class="col-12 mb-3">
            <h6 class="fw-medium">Gender</h6>

            <div class="hstack flex-wrap gap-3">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="maleRadio" value="male" {{ $data->gender === 'male' ? 'checked' : '' }}>
                    <label class="form-check-label" for="maleRadio">
                        Male
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="femaleRadio" value="female" {{ $data->gender === 'female' ? 'checked' : '' }}>
                    <label class="form-check-label" for="femaleRadio">
                        Female
                    </label>
                </div>
            </div>
        </div>

        @if ($data->id)
        <div class="col-12">
            <div class="form-check form-switch">
                <label for="customSwitchStatus" class="form-check-label">Active</label>
                <input type="checkbox" name="active" class="form-check-input" id="customSwitchStatus"
                    {{ $data->active == 1 ? 'checked' : '' }} value="1" />
            </div>
        </div>
        @else
        <div class="col-12 mb-3">
            <x-form-elements.password name="password" label="New Password" />
        </div>

        <div class="col-12 mb-3">
            <h6 class="fw-medium">Role</h6>

            <div class="hstack flex-wrap gap-3">
                <x-form-elements.radio name="role" label="Admin" value="admin" />
                <x-form-elements.radio name="role" label="Teacher" value="teacher" />
            </div>
        </div>
        @endif

        <div class="hstack gap-2 justify-content-end">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            @if ($data->id)
            <button type="submit" class="btn btn-primary">Save Data</button>
            @else
            <button type="submit" class="btn btn-success">Add New User</button>
            @endif
        </div>
    </div>

</x-modal>
