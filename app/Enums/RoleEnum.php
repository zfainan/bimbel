<?php

declare(strict_types=1);

namespace App\Enums;

use App\Models\Jabatan;
use App\Traits\EnumTrait;
use Illuminate\Support\Collection;

enum RoleEnum: string
{
    use EnumTrait;

    case CentralHead = 'Pimpinan Pusat';
    case Administrator = 'Administrator';
    case Tutor = 'Tentor';

    public static function getModelObjects(): Collection
    {
        return Jabatan::whereIn('role_name', self::toArray())->get();
    }
}
