<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\BelongsToBranch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static \Database\Factories\JadwalAjarFactory<self> factory($count = null, $state = [])
 *
 * @mixin \Illuminate\Database\Eloquent\Model
 *
 * @property      int                             $id
 * @property      int                             $id_tentor
 * @property      string                          $hari
 * @property      string                          $jam
 * @property      \Illuminate\Support\Carbon|null $created_at
 * @property      \Illuminate\Support\Carbon|null $updated_at
 * @property      int|null                        $id_program
 * @property      int|null                        $id_cabang
 * @property-read \App\Models\User|null           $tentor
 * @property-read \App\Models\Program|null        $program
 * @property-read \App\Models\Cabang|null         $branch
 */
class JadwalAjar extends Model
{
    use BelongsToBranch, HasFactory;

    protected $table = 'jadwal_ajar';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id_tentor', 'hari', 'jam', 'id_program'];

    public function tentor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_tentor', 'id');
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class, 'id_program', 'id_program');
    }
}
