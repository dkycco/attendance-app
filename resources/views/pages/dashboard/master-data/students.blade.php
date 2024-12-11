@section('title', 'Students')

<x-plugins name="datatable" />
<x-plugins name="datepicker" />
<x-plugins name="select2" />

<x-dashboard-layout>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Students</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">Master Data</li>
                        <li class="breadcrumb-item active">Students</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Students Table</h4>
                </div>
                <div class="card-body">
                    <div class="row">
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

            var menuJs = function() {
                const formId = 'form'
                const tableId = 'students-table'

                $('#' + tableId).on('click', '.action', function(e) {
                    e.preventDefault()

                    const url = this.getAttribute("href")

                    handleAjax(url)
                        .onSuccess((response) => {
                            bsModal().show(response)
                            studyProgram()
                            className()

                            handleFormSubmitAjax(formId).setDataTableId(tableId).init()
                        })
                        .execute()
                })

                function studyProgram() {

                    $('[name="faculty"]').on('change', function(e) {

                        const studyProgramSelect = $('[name="study_program"]');

                        if (this.value) {
                        handleAjax(`{{ url('master-data/students/study_program') }}/${this.value}`)
                            .onSuccess((response) => {
                                studyProgramSelect.empty().append('<option selected disabled>Select study program</option>');
                                if (response.data && response.data.length > 0) {
                                    response.data.forEach((program) => {
                                        studyProgramSelect.append(
                                            `<option value="${program.id}">${program.name}</option>`
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

                    $('[name="study_program"]').on('change', function(e) {

                        const classNameSelect = $('[name="class_name"]');

                        if (this.value) {
                        handleAjax(`{{ url('master-data/students/class_name') }}/${this.value}`)
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

            }()
        </script>
    @endpush
</x-dashboard-layout>
