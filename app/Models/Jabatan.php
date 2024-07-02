<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static \Database\Factories\JabatanFactory<self> factory($count = null, $state = [])
 *
 * @mixin \Illuminate\Database\Eloquent\Model
 *
 * @property int                             $id_jabatan
 * @property string                          $role_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Jabatan extends Model
{
    use HasFactory;

    protected $table = 'tb_jabatan';

    protected $primaryKey = 'id_jabatan';
}
