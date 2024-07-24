<?php

declare(strict_types=1);

namespace App\Enums;

use App\Traits\EnumTrait;

enum DayEnum: string
{
    use EnumTrait;

    case Monday = 'Senin';
    case Tuesday = 'Selasa';
    case Wednesday = 'Rabu';
    case Thursday = 'Kamis';
    case Friday = 'Jumat';
    case Saturday = 'Sabtu';
    case Sunday = 'Minggu';
}
