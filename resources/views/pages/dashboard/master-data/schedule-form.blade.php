<x-modal size="md" submitOnFooter :title="$data->id ? 'Edit Schedule' : 'Add New Schedule'" :form-action="$url ?? route('master-data.schedules.store')">
    @isset($url)
    @method('put')
    @endisset

    <div class="row mt-4 mb-3">
        @if ($data->id)
        <div class="col-12 mb-3 d-flex flex-column justify-content-center align-items-center">
            <img class="rounded shadow" src="{{ asset('images/bg-home.jpg') }}" width="300" alt="">
            <h5 class="text-center mt-3">{{ $data->course->name }}</h5>
            <span class="text-center text-muted">{{ $data->course->teacher->name }} / {{ $data->room->name }}</span>
        </div>
        @endif

        <div class="col-12 mb-3">
            <h6 class="fw-semibold">Course</h6>
            <select class="js-example-basic-single" name="course">
                <option selected disabled>Select a course</option>
                @foreach ($course as $item)
                <option value="{{ $item->id }}" {{ $item->id === $data->course_id ? 'selected' : '' }}>{{ $item->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-12 mb-3">
            <h6 class="fw-semibold">Room</h6>
            <select class="js-example-basic-single" name="room">
                <option selected disabled>Select a room</option>
                @foreach ($room as $item)
                <option value="{{ $item->id }}" {{ $item->id === $data->room_id ? 'selected' : '' }}>{{ $item->name }} | {{ $item->room_location }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-12 mb-3">
            <h6 class="fw-semibold">Semester</h6>
            <select class="js-example-basic-single" name="semester">
                <option selected disabled>Select a semester</option>
                @foreach ($semester as $item)
                <option value="{{ $item->id }}" {{ $item->id === $data->semester_id ? 'selected' : '' }}>{{ $item->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-12 mb-3">
            <h6 class="fw-semibold">Day</h6>
            <select class="js-example-basic-single" name="day">
                <option selected disabled>Select a day</option>
                @foreach ($day as $item)
                <option value="{{ $item }}" {{ $item === $data->day ? 'selected' : '' }}>{{ $item }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-12 mb-3">
            <x-form-elements.timepickr name="entry_time" label="Entry Time" class="time-picker" />
        </div>

        <div class="col-12">
            <x-form-elements.timepickr name="exit_time" label="Exit Time" class="time-picker" />
        </div>

        <script src="{{ asset('js/pages/select2.init.js') }}"></script>
        <script>

        $('.time-picker').each(function () {
            let defaultDate = null;

            @if (!empty($data->id))
                if ($(this).attr('id') === 'entry_time') {
                    defaultDate = "{{ \Carbon\Carbon::parse($data->entry_time)->format('H:i') }}";
                } else if ($(this).attr('id') === 'exit_time') {
                    defaultDate = "{{ \Carbon\Carbon::parse($data->exit_time)->format('H:i') }}";
                }
            @endif

            $(this).flatpickr({
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                defaultDate: defaultDate,
            });
        });

        </script>
    </div>


</x-modal>
