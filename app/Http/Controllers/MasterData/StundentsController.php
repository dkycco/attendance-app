<?php

namespace App\Http\Controllers\MasterData;

use App\DataTables\MasterData\StudentsDataTable;
use App\Http\Controllers\Controller;
use App\Models\ClassName;
use App\Models\Faculty;
use App\Models\Semester;
use App\Models\Student;
use App\Models\StudyProgram;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StundentsController extends Controller
{

    public function index(StudentsDataTable $datatable) {
        return $datatable->render('pages.dashboard.master-data.students');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->passsword),
                'gender' => $request->gender,
                'active' => 1
            ]);

            $user->assignRole('student');

            Student::create([
                'user_id' => $user,
                'nim' => $request->nim,
                'pob' => $request->pob,
                'dob' => $request->dob,
                'faculty_id' => $request->faculty,
                'study_program_id' => $request->study_program,
                'class_name_id' => $request->class_name,
            ]);

            DB::commit();
            return responseSuccess('Yeayy, Data is Successfully Saved');
        } catch (\Throwable $th) {
            DB::rollBack();
            return responseError($th);
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Student $student)
    {
        $faculty = Faculty::get();
        $studyProgram = StudyProgram::get();
        $semester = Semester::get();
        $className = ClassName::get();

        return view('pages.dashboard.master-data.students-form', [
            'data' => $student,
            'faculty' => $faculty,
            'study_program' => $studyProgram,
            'semester' => $semester,
            'class_name' => $className,
            'url' => route('master-data.students.update', $student->id)
        ]);
    }

    public function update(Request $request, Student $student)
    {
        try {
            DB::beginTransaction();

            $student->user->name = $request->name;
            $student->user->email = $request->email;
            $student->user->gender = $request->gender;
            $student->user->active = $request->active ? 1 : 0;
            $student->user->save();

            $student->nim = $request->nim;
            $student->pob = $request->pob;
            $student->dob = $request->dob;
            $student->faculty_id = $request->faculty;
            $student->study_program_id = $request->study_program;
            $student->class_name_id = $request->class_name;
            $student->save();


            DB::commit();
            return responseSuccess('Yeayy, Data is Successfully Saved');
        } catch (\Throwable $th) {
            DB::rollBack();
            return responseError($th);
        }
    }

    public function destroy(string $id)
    {
        //
    }

    public function study_program(StudyProgram $studyProgram, $id)
    {
        $data = $studyProgram->where('faculty_id', $id)->get();

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
}
