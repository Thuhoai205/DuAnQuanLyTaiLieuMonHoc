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
            DocumentTypeSeeder::class,
            SubjectSeeder::class,

            SubjectTeacherSeeder::class,

            DocumentSeeder::class,
            DocumentVersionSeeder::class,
            DownloadHistorySeeder::class,

            ActivityLogSeeder::class,
        ]);
    }
}