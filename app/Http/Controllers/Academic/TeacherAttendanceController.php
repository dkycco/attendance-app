<?php

namespace App\Http\Controllers\Academic;

use App\DataTables\Academic\TeacherAttendanceDataTable;
use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\TeacherAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\error;

class TeacherAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TeacherAttendanceDataTable $datatable)
    {
        return $datatable->render('pages.dashboard.academic.attendance');
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
    // public function edit(TeacherAttendance $teacher_attendance)
    // {
    //     return $teacherAttendance->id;
    //     // return view('pages.dashboard.academic.students-schedule');
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function view_student(TeacherAttendance $attendance)
    {

        return view('pages.dashboard.academic.students-attendance', [
            'attendance' => $attendance,
        ]);
    }

    // public function make_qr($qr) {
    //     $encrypted = Crypt::encrypt($qr);

    //     $encoded = base64_encode($encrypted);
    //     $data = substr($encoded, 0, 50);

    //     $paddedCode = $data . str_repeat('=', (4 - strlen($data) % 4) % 4);

    //     $decoded = base64_decode($paddedCode);
    //     $original = Crypt::decrypt($decoded);

    //     return response()->json([ $original]);
    // }

    public function save_qr(TeacherAttendance $id) {
        try {
            $randomData = Hash::make($id->id);

            $id->qr_code = $randomData;
            $id->save();

            return response()->json(['message' => 'QR code saved successfully']);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function make_qr(TeacherAttendance $id) {
        try {
            if (!$id->qr_code) {
                return response()->json(['error' => 'QR code not found. Please generate it first.'], 404);
            }

            $qrApiUrl = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" . urlencode($id->qr_code);

            return response()->json([
                'qr_code' => $qrApiUrl
            ]);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 1000);
        }
    }

    public function view_qr(TeacherAttendance $id) {
        $data = Schedule::findOrFail($id->schedule_id);

        return view('pages.dashboard.academic.view-qr', [
            'id' => $id->id,
            'data' => $data
        ]);
    }

}
