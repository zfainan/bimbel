<?php

declare(strict_types=1);

namespace App\Models;

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
 * @property-read \App\Models\User|null           $tentor
 */
class JadwalAjar extends Model
{
    use HasFactory;

    protected $table = 'jadwal_ajar';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id_tentor', 'hari', 'jam'];

    public function tentor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_tentor', 'id');
    }
}
