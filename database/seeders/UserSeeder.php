<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\Cabang;
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
            /** @var \App\Models\User $user */
            $user = User::factory()->make([
                'name' => $jabatan->role_name,
                'email' => sprintf('%s@example.com', Str::snake($jabatan->role_name)),
                'id_jabatan' => $jabatan->id_jabatan,
            ]);

            if ($jabatan->role_name == RoleEnum::Administrator->value) {
                $user->id_cabang = Cabang::where('nama', 'Pusat')->first()?->id_cabang;
            }

            $user->save();
        });
    }
}
