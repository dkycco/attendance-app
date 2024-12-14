@section('title', 'Users')

<x-plugins name="datatable" />
<x-plugins name="datepicker" />
<x-plugins name="select2" />

<x-dashboard-layout>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Users</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">Configuration</li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">User</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <a class="btn btn-primary btn-label waves-effect waves-light add" href="{{ route('configuration.users.create') }}">
                                <i class="mdi mdi-account-multiple-plus-outline label-icon align-middle fs-16 me-2"></i>
                                 Add User
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

            var userJs = function() {
                const formId = 'form'
                const tableId = 'user-table'

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

                    handleAjax(url)
                        .onSuccess((response) => {
                            bsModal().show(response)
                            bsDatePicker().init()

                            handleFormSubmitAjax(formId).setDataTableId(tableId).init()
                        })
                        .execute()
                })

            }()
        </script>
    @endpush
</x-dashboard-layout>
