<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Alumni
 *
 * @mixin Eloquent
 *
 * @property int         $id_alumni
 * @property double      $nilai_ujian
 * @property string      $pendidikan_lanjutan
 * @property string      $tahun_angkatan
 * @property int         $id_siswa
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 */
class Alumni extends Model
{
    use HasFactory;

    protected $table = 'tb_alumni';

    protected $primaryKey = 'id_alumni';

    protected $fillable = [
        'nilai_ujian',
        'pendidikan_lanjutan',
        'tahun_angkatan',
        'id_siswa',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }
}
