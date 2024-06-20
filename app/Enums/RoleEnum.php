<?php

namespace App\Enums;

use App\Models\Jabatan;
use App\Traits\EnumTrait;
use Illuminate\Support\Collection;

enum RoleEnum: string
{
    use EnumTrait;

    case SysAdmin = 'Admin';
    case CentralHead = 'Pimpinan Pusat';
    case Administrator = 'Bagian Administrasi';

    public static function getModelObjects(): Collection
    {
        return Jabatan::whereIn('role_name', self::toArray())->get();
    }
}
