<?php

declare(strict_types=1);

namespace App\Enums;

use App\Traits\EnumTrait;

enum StatusSiswaEnum: string
{
    use EnumTrait;

    case Aktif = 'Aktif';
    case Nonaktif = 'Nonaktif';
    case Alumni = 'Alumni';
}
