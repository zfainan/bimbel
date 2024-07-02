<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Cabang;
use Illuminate\Database\Seeder;

class CabangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cabang::factory()->create([
            'nama' => 'Pusat',
        ]);
    }
}
