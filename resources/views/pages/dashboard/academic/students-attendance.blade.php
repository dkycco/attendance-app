<x-modal size="lg" title="View Students">
    @isset($url)
    @method('put')
    @endisset

    <div class="row my-4">
        <div class="col-12 mb-3 d-flex flex-column justify-content-center align-items-center">
            <img class="rounded shadow" src="{{ asset('images/bg-home.jpg') }}" width="300" alt="">
            <h5 class="text-center mt-3">{{ $attendance->schedule->course->name }}</h5>
            <span class="text-center text-muted">{{ $attendance->schedule->course->teacher->name }} / {{ $attendance->schedule->room->name }}</span>
            <a href="{{ route('academic.attendance.view_qr', $attendance) }}" target="blank_" class="btn btn-primary btn-label waves-effect waves-light mt-3"><i class="ri-qr-code-line label-icon align-middle fs-16 me-2"></i> Make QR Code</a>
        </div>

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
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        'use strict'

        var studentJs = function () {

            $('#student_table').DataTable({
            });
        }()
    </script>
</x-modal>
