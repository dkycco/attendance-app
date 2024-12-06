@section('title', 'Schedules')

<x-plugins name="datatable" />
<x-plugins name="sweetalert" />

<x-dashboard-layout>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Schedules</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">Academic</li>
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
                const tableId = 'schedules-table'
                const d = new Date()
                let time = d.toLocaleTimeString()


                $('#' + tableId).on('click', '.action', function(e) {
                    e.preventDefault()
                    const url = this.getAttribute("href")
                    const actionName = this.innerText

                    if (actionName === 'Present') {
                        present(url)
                        return
                    }

                    if (actionName === 'Absent') {
                        console.log(actionName);
                        return
                    }
                })

                function present(url) {
                    alert().options({
                        title: 'Are you sure?',
                        text: 'You must be present on this schedule',
                        confirmButtonText: 'Yes',
                        showLoaderOnConfirm: true
                    }).confirmation(url, {
                        method: 'PUT',
                        onConfirm: (response) => {
                            handleAjax(url)
                            let sendData = {actual_entry_time: time}
                            data: JSON.stringify(sendData)
                            setData(data)
                                .onSuccess((response) => {

                                })
                                .execute()
                        }
                    })
                }

            }()
        </script>
    @endpush
</x-dashboard-layout>
