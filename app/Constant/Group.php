<?php

namespace App\Constant;

use ReflectionClass;

class Group
{
    const WOMEN = 'women';
    const MEN = 'men';
    const CHILDREN = 'children';

    public static function toArray(): array
    {
        $oClass = new ReflectionClass(__CLASS__);

        return $oClass->getConstants();
    }
}
