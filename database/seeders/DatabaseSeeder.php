<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            FacultySeeder::class,
            SubjectSeeder::class,
            DocumentTypeSeeder::class,
            SubjectTeacherSeeder::class,
            DocumentSeeder::class,
            DocumentVersionSeeder::class,
        ]);
    }
}