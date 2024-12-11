<?php

namespace App\Http\Controllers\Configuration;

use App\DataTables\Configuration\UsersDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function index(UsersDataTable $datatable) {
        return $datatable->render('pages.dashboard.configuration.users');
    }

    public function create(User $user)
    {
        return view('pages.dashboard.configuration.users-form', ['data' => $user]);
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

            $user->assignRole($request->role);

            DB::commit();
            return responseSuccess('Yeayy, Data is Successfully Saved');
        } catch (\Throwable $th) {
            DB::rollBack();
            return responseError($th);
        }
    }

    public function edit(User $user)
    {
        return view('pages.dashboard.configuration.users-form', [
            'data' => $user,
            'url' => route('configuration.users.update', $user->id)
        ]);
    }

    public function update(Request $request, User $user)
    {
        try {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->gender = $request->gender;
            $user->active = $request->active ? 1 : 0;
            $user->save();

            return responseSuccess('Yeayy, Data is Successfully Saved');
        } catch (\Throwable $th) {
            return responseError($th);
        }
    }

    public function destroy(string $id)
    {
        //
    }
}
