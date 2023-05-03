<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Fortify\ResetUserPassword;
use App\Enums\PhoneNumberEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Models\Gender;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
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

    public function search_ad(User $user){
        $ad = $user->ad()->paginate(5);
        return view('admin.user.search_ad',compact('ad','user'));
    }

    public function get_ad(User $user){
        $adGet = $user->adGet()->paginate(5);
        return view('admin.user.get_ad',compact('adGet','user'));
    }

    public function favorites(User $user){
        $ad = $user->liked_ad;
        $adGet = $user->liked_ad_gets;
        $result = $ad->merge($adGet)->paginate(5);
        return view('admin.user.favorites',compact('result','user'));
    }

    public function role(User $user){
        $roles = Role::all();
        $userRoles = $user->roles->pluck('id')->toArray();
        return view('admin.user.role',compact('roles','user','userRoles'));
    }

    public function updateUserRole(Request $request, User $user){
        $validatedData = Validator::make($request->all(), [
            'roles' => ['required', 'array', 'min:1'],
            'roles.*' => ['required', 'exists:roles,id'],
        ])->validate();

        $user->roles()->sync($request->roles);
        return redirect()->route('admin.user.role',['user'=>$user]);
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
