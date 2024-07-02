<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\BelongsToBranch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static \Database\Factories\ProgramFactory<self> factory($count = null, $state = [])
 *
 * @mixin \Illuminate\Database\Eloquent\Model
 *
 * @property      int                                                          $id_program
 * @property      string                                                       $nama_program
 * @property      int                                                          $harga
 * @property      string                                                       $deskripsi
 * @property      int|null                                                     $id_cabang
 * @property      \Illuminate\Support\Carbon|null                              $created_at
 * @property      \Illuminate\Support\Carbon|null                              $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Siswa[] $siswa
 * @property-read \App\Models\Cabang|null                                      $branch
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
