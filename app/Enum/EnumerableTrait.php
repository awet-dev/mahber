<?php

namespace App\Enum;

trait EnumerableTrait
{
    public static function toArray(): array
    {
        return array_reduce(self::cases(), function ($collector, self $enum) {
            $collector[] = $enum->name;
            return $collector;
        }, []);
    }
}
