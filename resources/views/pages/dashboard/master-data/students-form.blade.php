<x-modal size="md" :title="$data->id ? 'Edit user' : 'Add user'" :form-action="$url ?? route('master-data.students.store')">
    @isset($url)
    @method('put')
    @endisset

    <div class="text-center">
        <div class="bg-img-prof rounded">
            {{-- <img class="img" src="{{ asset('assets/images/background.jpg') }}" alt=""> --}}
        </div>
        <div class="profile-user position-relative d-inline-block mx-auto mt-n5  mb-4">
            <img src="{{ $data->photo ? '' : asset('images/users/user-dummy-img.jpg') }}"
                class="rounded-circle avatar-xl img-thumbnail user-profile-image  shadow" alt="user-profile-image">
        </div>
        <h5 class="fs-16 mb-1">{{ $data->name }}</h5>
        <p class="text-muted mb-0">{{ $data->nim }}</p>
    </div>

    <div class="row mt-4">
        <div class="col-12 mb-3">
            <x-form-elements.input name="nim" label="nim" :value="$data->nim" />
        </div>

        <div class="col-12 mb-3">
            <x-form-elements.input name="tmp_lahir" label="tmp_lahir" type="tmp_lahir" :value="$data->tmp_lahir" />
        </div>

        <div class="col-12">
            <div class="form-check form-switch">
                <label for="customSwitchStatus" class="form-check-label">Active</label>
                <input type="checkbox" name="active" class="form-check-input" id="customSwitchStatus"
                    {{ $data->active == 1 ? 'checked' : '' }} value="1" />
            </div>
        </div>
    </div>

</x-modal>
