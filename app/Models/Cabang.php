<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static \Database\Factories\CabangFactory<self> factory($count = null, $state = [])
 *
 * @mixin \Illuminate\Database\Eloquent\Model
 *
 * @property int                             $id_cabang
 * @property string                          $nama
 * @property string                          $alamat
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 */
class Cabang extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tb_cabang';

    protected $primaryKey = 'id_cabang';

    protected $fillable = [
        'nama',
        'alamat',
    ];
}
