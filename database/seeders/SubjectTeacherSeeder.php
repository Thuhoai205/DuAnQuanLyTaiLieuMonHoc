<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubjectTeacher;

class SubjectTeacherSeeder extends Seeder
{
    public function run(): void
    {
        SubjectTeacher::insert([

            [
                'user_id' => 2,
                'subject_code' => 'WEB101',
                'assigned_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'user_id' => 2,
                'subject_code' => 'DB101',
                'assigned_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'user_id' => 2,
                'subject_code' => 'JAVA101',
                'assigned_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}