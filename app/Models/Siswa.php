<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Siswa
 *
 * @mixin Eloquent
 *
 * @property int $id_siswa
 * @property string $nama
 * @property \Carbon\Carbon $tgl_lahir
 * @property string $jenis_kelamin
 * @property string $alamat
 * @property string $no_telp
 * @property string $nama_ortu
 * @property string $no_telp_ortu
 * @property string $pekerjaan_ortu
 * @property string $asal_sekolah
 * @property string $kelas
 * @property string $status
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 */
class Siswa extends Model
{
    use HasFactory;

    protected $table = 'tb_siswa';

    protected $primaryKey = 'id_siswa';

    protected $guarded = [
        'id_siswa',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'tgl_lahir' => 'date:d-m-Y',
    ];
}
