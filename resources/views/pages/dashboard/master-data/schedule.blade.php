@section('title', 'Schedules')

<x-plugins name="datatable" />
<x-plugins name="datepicker" />
<x-plugins name="select2" />
<x-plugins name="flatpickr" />

<x-dashboard-layout>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Schedules</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">Master Data</li>
                        <li class="breadcrumb-item active">Schedules</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Schedules Table</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <a class="btn btn-primary btn-label waves-effect waves-light add" href="{{ route('master-data.schedules.create') }}">
                                <i class="las la-calendar-plus label-icon align-middle fs-16 me-2"></i>
                                 Add Schedule
                            </a>
                        </div>
                        <div class="col-12">
                            {!! $dataTable->table() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        {!! $dataTable->scripts() !!}

        <script>
            'use strict'

            var scheduleJs = function() {
                const formId = 'form'
                const tableId = 'schedules-table'

                $('.add').on('click', function(e) {
                    e.preventDefault()

                    handleAjax(this.getAttribute("href"))
                        .onSuccess((response) => {
                            bsModal().show(response)

                            handleFormSubmitAjax(formId).setDataTableId(tableId).init()
                        })
                        .execute()
                })

                $('#' + tableId).on('click', '.action', function(e) {
                    e.preventDefault()

                    const url = this.getAttribute("href")
                    const actionName = this.innerText

                    handleAjax(url)
                        .onSuccess((response) => {
                            bsModal().show(response)
                            studyProgram()
                            className()
                            student()

                            if (actionName === 'Edit') {
                                handleFormSubmitAjax(formId).setDataTableId(tableId).init()
                                return
                            }

                            handleFormSubmitAjax(formId).setDataTableId(tableId).initModal()

                            $('#student_table').DataTable().ajax.reload();
                        })
                        .execute()
                })

                function studyProgram() {

                    $('[name="faculty"]').on('change', function(e) {

                        const studyProgramSelect = $('[name="study_program"]');

                        if (this.value) {
                        handleAjax(`{{ url('master-data/schedules/study_program') }}/${this.value}`)
                            .onSuccess((response) => {
                                studyProgramSelect.empty().append('<option selected disabled>Select study program</option>');
                                if (response.data && response.data.length > 0) {
                                    response.data.forEach((studyProgram) => {
                                        studyProgramSelect.append(
                                            `<option value="${studyProgram.id}">${studyProgram.name}</option>`
                                        );
                                    });
                                } else {
                                    studyProgramSelect.append('<option selected disabled>No study program available</option>');
                                }
                            })
                            .onError((error) => {
                                studyProgramSelect.empty().append('<option selected disabled>Error loading data</option>');
                                console.error(error);
                            })
                            .execute();
                        }
                    })
                }

                function className() {

                    $('[name="semester"]').on('change', function(e) {

                        const studyProgramSelect = $('[name="study_program"]');
                        const classNameSelect = $('[name="class_name"]');

                        if (this.value) {
                        handleAjax(`{{ url('master-data/schedules/class_name') }}/${studyProgramSelect.val()}/${this.value}`)
                            .onSuccess((response) => {
                                classNameSelect.empty().append('<option selected disabled>Select class name</option>');
                                if (response.data && response.data.length > 0) {
                                    response.data.forEach((className) => {
                                        classNameSelect.append(
                                            `<option value="${className.id}">${className.name}</option>`
                                        );
                                    });
                                } else {
                                    classNameSelect.append('<option selected disabled>No class name available</option>');
                                }
                            })
                            .onError((error) => {
                                classNameSelect.empty().append('<option selected disabled>Error loading data</option>');
                                console.error(error);
                            })
                            .execute();
                        }
                    })
                }

                function student() {

                    $('[name="class_name"]').on('change', function(e) {

                        const studentSelect = $('[name="student"]');

                        if (this.value) {
                        handleAjax(`{{ url('master-data/schedules/student') }}/${this.value}`)
                            .onSuccess((response) => {
                                studentSelect.empty().append('<option selected disabled>Select student</option>');
                                if (response.data && response.data.length > 0) {
                                    response.data.forEach((student) => {
                                        studentSelect.append(
                                            `<option value="${student.id}">${student.user.name}</option>`
                                        );
                                    });
                                } else {
                                    studentSelect.append('<option selected disabled>No student available</option>');
                                }
                            })
                            .onError((error) => {
                                studentSelect.empty().append('<option selected disabled>Error loading data</option>');
                                console.error(error);
                            })
                            .execute();
                        }
                    })
                }
            }()
        </script>
    @endpush
</x-dashboard-layout>
