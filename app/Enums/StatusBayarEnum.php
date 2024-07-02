<?php

declare(strict_types=1);

namespace App\Enums;

use App\Traits\EnumTrait;

enum StatusBayarEnum: string
{
    use EnumTrait;

    case Terbayar = 'Terbayar';
}
