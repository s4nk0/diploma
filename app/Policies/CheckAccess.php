<?php

namespace App\Policies;

use App\Enums\RolesEnum;
use App\Models\User;

class CheckAccess
{
    public function checkAccess(User $user,$permission){
        $roles = $user->roles()->get()->first();

        if ($roles){
            return $roles->permissions()->where('title',$permission)->get()->count();
        }else{
            return false;
        }
    }

    public function isAdmin(User $user){
        if ($user->hasRoles([RolesEnum::Admin->value])){
            return true;
        } else{
            return false;
        }
    }
}
