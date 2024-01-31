<?php

namespace App\Constant;

use ReflectionClass;

class Group
{
    const All = 'All';
    const Parents = 'Parents';
    const Men = 'Men';
    const Women = 'Women';
    const Children = 'Children';

    public static function toArray(bool $only_name = false): array
    {
        $oClass = new ReflectionClass(__CLASS__);

        $constants = $oClass->getConstants();

        return $only_name
            ? array_keys($constants)
            : $constants;
    }
}
