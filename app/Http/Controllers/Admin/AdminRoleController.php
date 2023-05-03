<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\StoreRoleRequest;
use App\Http\Requests\Admin\Role\UpdateRoleRequest;
use App\Models\Role;
use App\Models\User;


class AdminRoleController extends Controller
{
    public function index(User $user)
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(StoreRoleRequest $request)
    {
        //
    }

    public function show(Role $role)
    {
        //
    }

    public function edit(Role $role)
    {
        //
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        //
    }

    public function destroy(Role $role)
    {
        //
    }
}
