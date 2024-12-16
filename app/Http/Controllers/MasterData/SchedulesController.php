<?php

namespace App\Http\Controllers\MasterData;

use App\DataTables\MasterData\SchedulesDataTable;
use App\Http\Controllers\Controller;
use App\Models\ClassName;
use App\Models\Course;
use App\Models\Faculty;
use App\Models\Room;
use App\Models\Schedule;
use App\Models\Semester;
use App\Models\Student;
use App\Models\StudentSchedule;
use App\Models\StudyProgram;
use Illuminate\Http\Request;

class SchedulesController extends Controller
{
    public function index(SchedulesDataTable $datatable)
    {
        return $datatable->render('pages.dashboard.master-data.schedule');
    }

    public function create(Schedule $schedule)
    {
        $course = Course::get();
        $room = Room::get();
        $semester = Semester::get();
        $day = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        return view('pages.dashboard.master-data.schedule-form', [
            'data' => $schedule,
            'course' => $course,
            'room' => $room,
            'semester' => $semester,
            'day' => $day,
        ]);
    }

    public function store(Request $request)
    {
        try {
            Schedule::create([
              'course_id' => $request->course,
              'room_id' => $request->room,
              'semester_id' => $request->course,
              'day' => $request->day,
              'entry_time' => $request->entry_time,
              'exit_time' => $request->exit_time
            ]);

            return responseSuccess('Yeayy, Data is Successfully Saved');
        } catch (\Throwable $th) {
            return responseError($th);
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Schedule $schedule)
    {
        $course = Course::get();
        $room = Room::get();
        $semester = Semester::get();
        $day = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        return view('pages.dashboard.master-data.schedule-form', [
            'data' => $schedule,
            'course' => $course,
            'room' => $room,
            'semester' => $semester,
            'day' => $day,
            'url' => route('master-data.schedules.update', $schedule->id)
        ]);
    }

    public function update(Request $request, Schedule $schedule)
    {
        try {
            $schedule->course_id = $request->course;
            $schedule->room_id = $request->room;
            $schedule->semester_id = $request->semester;
            $schedule->entry_time = $request->entry_time;
            $schedule->exit_time = $request->exit_time;
            $schedule->save();

            return responseSuccess('Yeayy, Data is Successfully Saved');
        } catch (\Throwable $th) {
            return responseError($th);
        }
    }

    public function destroy(string $id)
    {
        //
    }

    public function view_student(Schedule $schedule)
    {
        $faculty = Faculty::get();
        $semester = Semester::get();
        $student = StudentSchedule::where('schedule_id', $schedule->id)->get();

        return view('pages.dashboard.master-data.students-schedule', [
            'faculty' => $faculty,
            'semester' => $semester,
            'student' => $student,
            'schedule_id' => $schedule->id
        ]);
    }

    public function study_program($id)
    {
        $data = StudyProgram::where('faculty_id', $id)->get();

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function class_name($study_program, $semester)
    {
        $data = ClassName::where('study_program_id', $study_program)
            ->where('semester_id', $semester)
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function student($id)
    {
        $uniqueStudent = StudentSchedule::select('student_id')
        ->groupBy('student_id')
        ->pluck('student_id');

        $student = Student::where('class_name_id', $id)
            ->whereNotIn('id', $uniqueStudent)
            ->with('user')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $student,
            'uniq' => $uniqueStudent
        ]);
    }

    public function store_student(Request $request)
    {
        try {
            StudentSchedule::create([
                'schedule_id' => $request->schedule_id,
                'student_id' => $request->student
            ]);

            return responseSuccess('Yeayy, Data is Successfully Saved');
        } catch (\Throwable $th) {
            return responseError($th);
        }
    }
}
