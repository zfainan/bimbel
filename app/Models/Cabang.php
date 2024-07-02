<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cabang extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tb_cabang';

    protected $primaryKey = 'id_cabang';

    protected $fillable = [
        'nama',
        'alamat',
    ];
}
