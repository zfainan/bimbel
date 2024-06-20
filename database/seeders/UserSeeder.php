<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\Jabatan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RoleEnum::getModelObjects()->each(function (Jabatan $jabatan) {
            User::factory()->create([
                'name' => $jabatan->role_name,
                'email' => sprintf('%s@example.com', Str::snake($jabatan->role_name)),
                'id_jabatan' => $jabatan->id_jabatan,
            ]);
        });
    }
}
