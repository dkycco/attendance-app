<?php

namespace App\Http\Controllers\Academic;

use App\DataTables\Academic\SchedulesAcademicDataTable;
use App\Http\Controllers\Controller;
use App\Models\Schedules;
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
    public function update(Request $request, Schedules $schedules)
    {

    }

    public function present(Request $request, Schedules $schedules)
    {
        try {
            $schedules->actual_entry_time = $request->actual_entry_time;
            $schedules->save();

            return responseSuccess('Yeayy, Data is Successfully Saved');
        } catch (\Throwable $th) {
            return responseError($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
