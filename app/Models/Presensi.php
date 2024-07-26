<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\BelongsToBranch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static \Database\Factories\PresensiFactory<self> factory($count = null, $state = [])
 *
 * @mixin \Illuminate\Database\Eloquent\Model
 *
 * @property      int                             $id
 * @property      int|null                        $id_pertemuan
 * @property      int|null                        $id_cabang
 * @property      int|null                        $id_siswa
 * @property      string                          $waktu
 * @property      \Illuminate\Support\Carbon|null $created_at
 * @property      \Illuminate\Support\Carbon|null $updated_at
 * @property      bool|null                       $hadir
 * @property-read \App\Models\Siswa|null          $siswa
 * @property-read \App\Models\Cabang|null         $branch
 */
class Presensi extends Model
{
    use BelongsToBranch, HasFactory;

    protected $table = 'presensi';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = ['id_pertemuan', 'id_siswa', 'waktu', 'hadir'];

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }
}
