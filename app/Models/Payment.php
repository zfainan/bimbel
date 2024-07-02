<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\BelongsToBranch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static \Database\Factories\PaymentFactory<self> factory($count = null, $state = [])
 *
 * @mixin \Illuminate\Database\Eloquent\Model
 *
 * @property      int                             $id_pembayaran
 * @property      int                             $jumlah
 * @property      string                          $tanggal
 * @property      int                             $sisa_bayar
 * @property      string                          $status
 * @property      int                             $id_siswa
 * @property      int                             $id_program
 * @property      int|null                        $id_cabang
 * @property      \Illuminate\Support\Carbon|null $created_at
 * @property      \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Cabang|null         $branch
 */
class Payment extends Model
{
    use BelongsToBranch, HasFactory;

    protected $table = 'tb_pembayaran';

    protected $primaryKey = 'id_pembayaran';

    protected $fillable = [
        'jumlah',
        'tanggal',
        'id_program',
        'id_siswa',
        'sisa_bayar',
        'status',
    ];

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class, 'id_program');
    }
}
