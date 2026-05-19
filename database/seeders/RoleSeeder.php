<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::insert([
            ['role_name' => 'Admin'],
            ['role_name' => 'GiangVien'],
            ['role_name' => 'SinhVien'],
        ]);
    }
}