<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Fortify\ResetUserPassword;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Models\Gender;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class AdminUserController extends Controller
{

    public function index()
    {
        $users = User::orderBy('created_at','desc')->paginate(6);
        return view('admin.user.index',compact('users'));
    }

    public function create()
    {
        $genders = Gender::all();
        return view('admin.user.create',compact('genders'));
    }

    public function store(Request $request, CreatesNewUsers $createsNewUsers)
    {
        $createsNewUsers->create($request->all());
        return redirect()->route('admin.user.index');
    }

    public function show(User $user)
    {
        return view('admin.user.show',compact('user'));
    }


    public function edit(User $user)
    {
        $genders = Gender::all();
        return view('admin.user.edit',compact('genders','user'));
    }

    public function update(UpdateUserRequest $request, User $user, ResetUserPassword $resetUserPassword)
    {

        $user->update($request->all());
        if ($request->password){
            $resetUserPassword->reset($user,$request->all());
        }
        if (isset($request->photo)) {
            $user->updateProfilePhoto($request->photo);
        }

        return redirect()->route('admin.user.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.user.index');
    }
}
