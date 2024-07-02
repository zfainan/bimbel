<?php

namespace App\Models;

use App\Traits\BelongsToBranch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Payment
 *
 * @mixin Eloquent
 *
 * @property int $id_pembayaran
 * @property int $jumlah
 * @property \Carbon\Carbon $tanggal
 * @property int $sisa_bayar
 * @property string $status
 * @property int $id_siswa
 * @property int $id_program
 * @property string $id_cabang
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \App\Models\Cabang|null $branch
 *
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo branch
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
        'status'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    public function program()
    {
        return $this->belongsTo(Program::class, 'id_program');
    }
}
