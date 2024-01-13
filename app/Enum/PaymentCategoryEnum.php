<?php

namespace App\Enum;

enum PaymentCategoryEnum
{
    use EnumerableTrait;

    case MEMBER;
    case HELP;
    case KIDS;
}
