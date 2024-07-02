<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @method static \Database\Factories\UserFactory<self> factory($count = null, $state = [])
 *
 * @mixin \Illuminate\Database\Eloquent\Model
 *
 * @property      int                             $id
 * @property      string                          $name
 * @property      string                          $email
 * @property      \Illuminate\Support\Carbon|null $email_verified_at
 * @property      string                          $password
 * @property      int                             $id_jabatan
 * @property      int|null                        $id_cabang
 * @property      string|null                     $remember_token
 * @property      \Illuminate\Support\Carbon|null $created_at
 * @property      \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Jabatan|null        $jabatan
 * @property-read \App\Models\Cabang|null         $branch
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'id_jabatan',
        'id_cabang',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function jabatan(): BelongsTo
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan');
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Cabang::class, 'id_cabang');
    }
}
