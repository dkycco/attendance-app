<?php

namespace App\Http\Controllers\Configuration;

use App\DataTables\Configuration\UsersDataTable;
use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UsersDataTable $datatable) {
        return $datatable->render('pages.dashboard.configuration.users');
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
    public function edit(User $user)
    {
        return view('pages.dashboard.configuration.users-form', [
            'data' => $user,
            'url' => route('configuration.users.update', $user->id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        try {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->active = $request->active;
            $user->save();

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
