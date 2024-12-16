<?php

namespace App\Http\Controllers\Academic;

use App\DataTables\Academic\SchedulesAcademicDataTable;
use App\Http\Controllers\Controller;
use App\Models\Faculty;
use App\Models\Schedule;
use App\Models\Semester;
use App\Models\StudentSchedule;
use App\Models\TeacherAttendance;
use Illuminate\Http\Request;

class SchedulesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SchedulesAcademicDataTable $datatables)
    {
        return $datatables->render('pages.dashboard.academic.schedule');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TeacherAttendance $schedules)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // public function view_student(StudentSchedule $studentSchedule, $schedule)
    // {
    //     $data = $studentSchedule->where('schedule_id', $schedule)->get();
    //     $faculty = Faculty::get();
    //     $semester = Semester::get();

    //     return view('pages.dashboard.academic.students-schedule', [
    //         'schedule_id' => $schedule,
    //         'data' => $data,
    //         'faculty' => $faculty,
    //         'semester' => $semester
    //     ]);
    // }

    public function view_student(Schedule $schedule)
    {
        $student = StudentSchedule::where('schedule_id', $schedule->id)->get();

        return view('pages.dashboard.academic.students-schedule', [
            'schedule' => $schedule,
            'student' => $student
        ]);
    }

    public function present($schedule)
    {
        $data = Schedule::where('id', $schedule)->first();

        try {
            TeacherAttendance::create([
                'teacher_id' => getUser('id'),
                'schedule_id' => $data->id,
                'date' => now(),
                'status' => '1',
                'entry_time' => now()
            ]);

            return responseSuccess('Yeayy, Data is Successfully Saved');
        } catch (\Throwable $th) {
            return responseError($th);
        }
    }
}
