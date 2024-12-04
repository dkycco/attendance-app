@section('title', 'Users')

<x-plugins name="datatable" />

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
    @endpush
</x-dashboard-layout>
