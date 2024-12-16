<x-modal size="lg" title="View Students">
    @isset($url)
    @method('put')
    @endisset

    <div class="row my-4">
        @if ($schedule->id)
        <div class="col-12 mb-3 d-flex flex-column justify-content-center align-items-center">
            <img class="rounded shadow" src="{{ asset('images/bg-home.jpg') }}" width="300" alt="">
            <h5 class="text-center mt-3">{{ $schedule->course->name }}</h5>
            <span class="text-center text-muted">{{ $schedule->course->teacher->name }} / {{ $schedule->room->name }}</span>
        </div>
        @endif

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
                        </tr>
                        @endforeach
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
