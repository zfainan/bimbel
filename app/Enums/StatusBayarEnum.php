<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum StatusBayarEnum: string
{
    use EnumTrait;

    case Terbayar = 'Terbayar';
}
