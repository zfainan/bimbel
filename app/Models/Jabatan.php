<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Jabatan
 *
 * @mixin Eloquent
 *
 * @property int                 $id_jabatan
 * @property string              $role_name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 */
class Jabatan extends Model
{
    use HasFactory;

    protected $table = 'tb_jabatan';

    protected $primaryKey = 'id_jabatan';
}
