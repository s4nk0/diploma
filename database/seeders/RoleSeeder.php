<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $admin = [
            'id'=>1,
            'title'=>'Admin',
        ];

        $user = [
            'id'=>2,
            'title'=>'User',
        ];

        $roles = [$admin,$user];

        $ad_permissions = [
            ['title'=>'ad_view'],
            ['title'=>'ad_create',],
            ['title'=>'ad_update',],
            ['title'=>'ad_delete',],
            ['title'=>'ad_restore',],
            ['title'=>'ad_forceDelete',],
        ];

        $adGet_permissions = [
            ['title'=>'adGet_view'],
            ['title'=>'adGet_create',],
            ['title'=>'adGet_update',],
            ['title'=>'adGet_delete',],
            ['title'=>'adGet_restore',],
            ['title'=>'adGet_forceDelete',],
        ];

        Permission::insert(array_merge($ad_permissions, $adGet_permissions) );

        Role::insert($roles);

        $adminRole = Role::find($admin['id']);
        $adminRole->permissions()->attach(Permission::all()->pluck('id')->toArray());

        $userRole = Role::find($user['id']);
        $userPermissions = Permission::orWhere('title','ad_view')
            ->orWhere('title','ad_create')
            ->orWhere('title','ad_update')
            ->orWhere('title','ad_delete')
            ->orWhere('title','adGet_create')
            ->orWhere('title','adGet_update')
            ->orWhere('title','adGet_delete')
            ->get();

        $userRole->permissions()->attach($userPermissions->pluck('id')->toArray());
    }
}
