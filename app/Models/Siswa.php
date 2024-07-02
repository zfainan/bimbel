<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\StatusSiswaEnum;
use App\Jobs\CreateAlumni;
use App\Scopes\BranchScope;
use App\Traits\BelongsToBranch;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @method static \Database\Factories\SiswaFactory<self> factory($count = null, $state = [])
 *
 * @mixin \Illuminate\Database\Eloquent\Model
 *
 * @property      int                                                            $id_siswa
 * @property      string                                                         $nama
 * @property      string                                                         $tgl_lahir
 * @property      string                                                         $alamat
 * @property      string                                                         $no_telp
 * @property      string                                                         $nama_ortu
 * @property      string                                                         $no_telp_ortu
 * @property      string                                                         $pekerjaan_ortu
 * @property      string                                                         $asal_sekolah
 * @property      string                                                         $kelas
 * @property      string                                                         $status
 * @property      int|null                                                       $id_program
 * @property      int|null                                                       $id_cabang
 * @property      \Illuminate\Support\Carbon|null                                $created_at
 * @property      \Illuminate\Support\Carbon|null                                $updated_at
 * @property      mixed                                                          $jenisKelamin
 * @property      mixed                                                          $jenis_kelamin
 * @property      mixed                                                          $sisaBayar
 * @property      mixed                                                          $sisa_bayar
 * @property-read \App\Models\Program|null                                       $program
 * @property-read \App\Models\Alumni|null                                        $alumni
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Payment[] $payments
 * @property-read \App\Models\Cabang|null                                        $branch
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
        return Attribute::make(fn (string $value) => 'L' == $value ? 'Laki-laki' : 'Perempuan');
    }

    public function sisaBayar(): Attribute
    {
        return Attribute::make(get: function () {
            if (! $this->id_program) {
                return 0;
            }

            return $this->program->harga - $this->payments->where('id_program', $this->id_program)
                ->sum('jumlah');
        });
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class, 'id_program', 'id_program');
    }

    public function alumni(): HasOne
    {
        return $this->hasOne(Alumni::class, 'id_siswa', 'id_siswa');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'id_siswa', 'id_siswa');
    }
}
