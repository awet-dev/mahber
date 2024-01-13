<?php

namespace App\Enum;

enum RoleEnum
{
    use EnumerableTrait;

    case ADMIN;
    case USER;
    case FINANCE;
    case TEACHER;

    public function getDescription(): string
    {
        return match ($this) {
            self::ADMIN => 'Admin can do every thing on the system',
            self::USER => 'User can do every thing on its own section',
            self::FINANCE => 'Finance can do every thing on the system payment',
            self::TEACHER => 'Teacher can do every thing on the kids section',
        };
    }
}
