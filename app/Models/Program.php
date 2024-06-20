<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Program
 *
 * @mixin Eloquent
 *
 * @property int         $id_program
 * @property string      $nama_program
 * @property int         $harga
 * @property string      $deskripsi
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 */
class Program extends Model
{
    use HasFactory;

    protected $table = 'tb_program';

    protected $primaryKey = 'id_program';
}
