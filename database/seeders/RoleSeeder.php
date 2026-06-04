<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::updateOrCreate(
            ['role_id' => 1],
            ['role_name' => 'admin']
        );

        Role::updateOrCreate(
            ['role_id' => 2],
            ['role_name' => 'lecturer']
        );

        Role::updateOrCreate(
            ['role_id' => 3],
            ['role_name' => 'student']
        );
    }
}