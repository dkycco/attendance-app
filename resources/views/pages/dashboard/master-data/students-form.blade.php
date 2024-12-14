<x-modal-profile size="md" :title="$data->id ? 'Edit Student' : 'Add New Student'" :photo="$data->photo ?? asset('images/users/multi-user.jpg')" :form-action="$url ?? route('master-data.students.store')">
    @isset($url)
    @method('put')
    @endisset

    <div class="row mt-4">
        <div class="col-12 mb-3">
            <x-form-elements.input name="name" label="Name" :value="$data->user->name" />
        </div>

        <div class="col-12 mb-3">
            <x-form-elements.input name="email" label="Email" type="email" :value="$data->user->email" />
        </div>

        <div class="col-12 mb-3">
            <h6 class="fw-medium">Gender</h6>

            <div class="hstack flex-wrap gap-3">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="maleRadio" value="male" {{ $data->user->gender === 'male' ? 'checked' : '' }}>
                    <label class="form-check-label" for="maleRadio">
                        Male
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="femaleRadio" value="female" {{ $data->user->gender === 'female' ? 'checked' : '' }}>
                    <label class="form-check-label" for="femaleRadio">
                        Female
                    </label>
                </div>
            </div>
        </div>

        @if ($data->id)
        <div class="col-12 mb-3">
            <div class="form-check form-switch">
                <label for="customSwitchStatus" class="form-check-label">Active</label>
                <input type="checkbox" name="active" class="form-check-input" id="customSwitchStatus"
                    {{ $data->user->active == 1 ? 'checked' : '' }} value="1" />
            </div>
        </div>
        @else
        <div class="col-12 mb-3">
            <x-form-elements.password name="password" label="New Password" />
        </div>
        @endif

        <div class="col-12 mb-3">
            <x-form-elements.input name="nim" label="NIM" :value="$data->nim"/>
        </div>

        <div class="col-12 mb-3">
            <x-form-elements.input name="pob" label="Place of Birth" :value="$data->pob" />
        </div>

        <div class="col-12 mb-3">
            <x-form-elements.date name="dob" label="Date of Birth" :value="$data->dob" />
        </div>

        <div class="col-12 mb-3">
            <h6 class="fw-semibold">Faculty</h6>
            <select class="js-example-basic-single" name="faculty">
                <option selected disabled>Select faculty</option>
                @foreach ($faculty as $item)
                <option value="{{ $item->id }}" {{ $data->faculty_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-12 mb-3">
            <h6 class="fw-semibold">Study Program</h6>
            <select class="js-example-basic-single" name="study_program">
                <option selected disabled>Select a faculty first</option>
                @if ($data->id)
                @foreach ($study_program as $item)
                <option value="{{ $item->id }}" {{ $data->study_program_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                @endforeach
                @endif
            </select>
        </div>

        <div class="col-12 mb-3">
            <h6 class="fw-semibold">Semester</h6>
            <select class="js-example-basic-single" name="semester">
                <option selected disabled>Select a study program first</option>
                @foreach ($semester as $item)
                <option value="{{ $item->id }}" {{ $data->semester_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-12 mb-3">
            <h6 class="fw-semibold">Class</h6>
            <select class="js-example-basic-single" name="class_name">
                <option selected disabled>Select a semester first</option>
                @if ($data->id)
                @foreach ($class_name as $item)
                <option value="{{ $item->id }}" {{ $data->class_name_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                @endforeach
                @endif
            </select>
        </div>

        <div class="hstack gap-2 justify-content-end">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            @if ($data->id)
            <button type="submit" class="btn btn-primary">Save Data</button>
            @else
            <button type="submit" class="btn btn-success">Add New User</button>
            @endif
        </div>
    </div>

    <script src="{{ asset('js/pages/select2.init.js') }}"></script>

</x-modal>
