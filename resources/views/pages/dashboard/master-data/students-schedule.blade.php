<x-modal size="lg" title="Edit Students" :form-action="route('master-data.schedules.store_student')">
    @isset($url)
    @method('put')
    @endisset

    <input type="text" name="schedule_id" value="{{ $schedule_id }}" hidden>

    <div class="row my-4">
        <div class="col-md-6 mb-3">
            <h6 class="fw-semibold">Faculty</h6>
            <select class="js-example-basic-single" name="faculty">
                <option selected disabled>Select a faculty</option>
                @foreach ($faculty as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6 mb-3">
            <h6 class="fw-semibold">Study Program</h6>
            <select class="js-example-basic-single" name="study_program">
                <option selected disabled>Select a faculty first</option>
            </select>
        </div>

        <div class="col-md-6 mb-3">
            <h6 class="fw-semibold">Semester</h6>
            <select class="js-example-basic-single" name="semester">
                <option selected disabled>Select a semester</option>
                @foreach ($semester as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6 mb-3">
            <h6 class="fw-semibold">Class Name</h6>
            <select class="js-example-basic-single" name="class_name">
                <option selected disabled>Select a study program first</option>
            </select>
        </div>

        <div class="col-md-6 mb-3">
            <h6 class="fw-semibold">Student</h6>
            <select class="js-example-basic-single" name="student">
                <option selected disabled>Select a student</option>
            </select>
        </div>

        <div class="col-md-6 mb-3 align-self-end">
            <button class="btn btn-primary btn-label waves-effect waves-light w-100 add-student">
                <i class="las la-calendar-plus label-icon align-middle fs-16 me-2"></i>
                Add
            </button>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <div class="card-body">
                    <table id="student_table" class="table" style="width:100%">
                        <thead>
                            <tr>
                                <th data-ordering="false">No</th>
                                <th>Name</th>
                                <th>NIM</th>
                                <th>Class Name</th>
                                <th>Gender</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($student as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->student->user->name }}</td>
                                <td>{{ $item->student->nim }}</td>
                                <td>{{ $item->student->class_name->name }}</td>
                                <td>{!! $item->student->user->gender === 'male' ? '<span class="d-flex align-item-middle gap-2"><i class="fs-5 text-success las la-mars"></i> Male</span>' : '<span class="d-flex align-item-middle gap-2"><i class="fs-5 text-primary las la-venus"></i> Female</span>' !!}</td>
                                <td><a class="btn btn-sm btn-danger" href=""><i class="las la-trash-alt"></i></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/pages/select2.init.js') }}"></script>
    <script>
        'use strict'

        var studentJs = function () {

            $('#student_table').DataTable({
            });
        }()
    </script>
</x-modal>
