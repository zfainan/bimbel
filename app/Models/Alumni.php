<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\BelongsToBranch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static \Database\Factories\AlumniFactory<self> factory($count = null, $state = [])
 *
 * @mixin \Illuminate\Database\Eloquent\Model
 *
 * @property      int                             $id_alumni
 * @property      float                           $nilai_ujian
 * @property      string                          $pendidikan_lanjutan
 * @property      string                          $tahun_angkatan
 * @property      int                             $id_siswa
 * @property      int|null                        $id_cabang
 * @property      \Illuminate\Support\Carbon|null $created_at
 * @property      \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Siswa|null          $siswa
 * @property-read \App\Models\Cabang|null         $branch
 */
class Alumni extends Model
{
    use BelongsToBranch, HasFactory;

    protected $table = 'tb_alumni';

    protected $primaryKey = 'id_alumni';

    protected $fillable = [
        'nilai_ujian',
        'pendidikan_lanjutan',
        'tahun_angkatan',
        'id_siswa',
    ];

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }
}
