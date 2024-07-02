<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\Jabatan;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RoleEnum::getCollection()->each(function (string $roleName) {
            Jabatan::firstOrCreate(['role_name' => $roleName]);
        });
    }
}
