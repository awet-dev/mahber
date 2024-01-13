<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\User;
use App\Enum\RoleEnum;

class RoleRepository
{
    public static function getByName(RoleEnum $role_enum): Role
    {
        return Role::where('name', '=', $role_enum->name)
            ->first();
    }

    public static function userHasRole(User $user, RoleEnum $role_enum): bool
    {
        return $user->roles()
            ->where('name', '=', $role_enum->name)
            ->exists();
    }
}
