<?php

namespace App\Http\Controllers\MasterData;

use App\DataTables\MasterData\StudentsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Students;
use Illuminate\Http\Request;

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
        // if ($user->hasRole(['mahasiswa'])) {
        //     Mahasiswa::where('user_id', $user->id)->update([
        //         'nim' => $request->nim,
        //         'tmp_lahir' => $request->tmp_lahir,
        //         'tgl_lahir' => $request->tgl_lahir,
        //         // 'fakultas_id' => $request->fakultas_id,
        //         // 'prodi_id' => $request->prodi_id,
        //         // 'kelas_id' => $request->kelas_id,
        //     ]);
        // }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Students $student)
    {
        return view('pages.dashboard.master-data.students-form', [
            'data' => $student,
            'url' => route('master-data.students.update', $student->id)
        ]);
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
