<?php

namespace App\Models;

use App\Enums\StatusSiswaEnum;
use App\Jobs\CreateAlumni;
use App\Scopes\BranchScope;
use App\Traits\BelongsToBranch;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
 * @property string $id_cabang
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \App\Models\Cabang|null $branch
 *
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo branch
 */
class Siswa extends Model
{
    use BelongsToBranch, HasFactory;

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

    protected static function booted(): void
    {
        static::addGlobalScope(new BranchScope());

        static::creating(function (self $model) {
            $model->id_cabang = auth()->user()?->id_cabang;
        });

        static::created(function (self $model) {
            if ($model->status == StatusSiswaEnum::Alumni->value) {
                dispatch_sync(new CreateAlumni($model));
            }
        });

        static::updated(function (self $model) {
            if ($model->status == StatusSiswaEnum::Alumni->value) {
                dispatch_sync(new CreateAlumni($model));
            }
        });
    }

    public function jenisKelamin(): Attribute
    {
        return Attribute::make(fn (string $value) => $value == 'L' ? 'Laki-laki' : 'Perempuan');
    }

    public function alumni(): HasOne
    {
        return $this->hasOne(Alumni::class, 'id_siswa');
    }
}
