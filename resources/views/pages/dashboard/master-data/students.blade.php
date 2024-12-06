@section('title', 'Students')

<x-plugins name="datatable" />

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

                            handleFormSubmitAjax(formId).setDataTableId(tableId).init()
                        })
                        .execute()
                })

            }()
        </script>
    @endpush
</x-dashboard-layout>
