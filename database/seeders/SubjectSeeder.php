<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;
use Illuminate\Support\Str;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        Subject::insert([

            [
                'subject_code' => 'WEB101',
                'subject_name' => 'Lập trình Web',
                'slug' => Str::slug('Lập trình Web'),
                'description' => 'Môn học phát triển website bằng HTML, CSS, JavaScript và Laravel',
                'thumbnail' => null,
                'icon' => 'fa-globe',
                'color' => 'blue',
                'total_documents' => 0,
                'is_featured' => true,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'subject_code' => 'DB101',
                'subject_name' => 'Cơ sở dữ liệu',
                'slug' => Str::slug('Cơ sở dữ liệu'),
                'description' => 'Môn học về thiết kế cơ sở dữ liệu và SQL',
                'thumbnail' => null,
                'icon' => 'fa-database',
                'color' => 'green',
                'total_documents' => 0,
                'is_featured' => false,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'subject_code' => 'JAVA101',
                'subject_name' => 'Lập trình Java',
                'slug' => Str::slug('Lập trình Java'),
                'description' => 'Môn học Java cơ bản và hướng đối tượng',
                'thumbnail' => null,
                'icon' => 'fa-coffee',
                'color' => 'red',
                'total_documents' => 0,
                'is_featured' => false,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}