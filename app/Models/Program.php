<?php

namespace App\Models;

use App\Traits\BelongsToBranch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Program
 *
 * @mixin Eloquent
 *
 * @property int $id_program
 * @property string $nama_program
 * @property int $harga
 * @property string $deskripsi
 * @property string $id_cabang
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \App\Models\Cabang|null $branch
 *
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo branch
 */
class Program extends Model
{
    use BelongsToBranch, HasFactory;

    protected $table = 'tb_program';

    protected $primaryKey = 'id_program';

    protected $fillable = [
        'nama_program',
        'harga',
        'deskripsi',
    ];
}
