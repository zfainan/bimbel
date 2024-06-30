<?php

namespace App\Models;

use App\Traits\BelongsToBranch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
 * @property \Illuminate\Database\Eloquent\Collection|null $siswa
 * @property \App\Models\Cabang|null $branch
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 *
 * @method \Illuminate\Database\Eloquent\Collection|null siswa
 * @method \Illuminate\Database\Eloquent\Relations\HasMany branch
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

    public function siswa(): HasMany
    {
        return $this->hasMany(Siswa::class, 'id_program');
    }
}
