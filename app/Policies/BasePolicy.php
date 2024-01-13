<?php

namespace App\Policies;

use App\Models\User;
use App\Enum\RoleEnum;
use App\Repositories\RoleRepository;

class BasePolicy
{
    public function before(User $user, string $ability): bool|null
    {
        if (RoleRepository::userHasRole($user, RoleEnum::ADMIN)) {
            return true;
        }

        return null;
    }
}
