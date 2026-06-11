<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;
use App\Models\Faculty;
use Illuminate\Support\Str;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        $cntt = Faculty::where('faculty_code', 'CNTT')->first();

        Subject::updateOrCreate(
            ['subject_code' => 'WEB101'],
            [
                'subject_name' => 'Lập trình Web',
                'slug' => Str::slug('Lập trình Web'),
                'description' => 'Môn học phát triển website bằng HTML, CSS, JavaScript và Laravel',
                'thumbnail' => null,
                'icon' => 'fa-solid fa-globe',
                'color' => 'blue',
                'status' => 'active',
                'faculty_id' => $cntt?->faculty_id,
                'created_by' => 1,
                'updated_by' => 1,
            ]
        );

        Subject::updateOrCreate(
            ['subject_code' => 'DB101'],
            [
                'subject_name' => 'Cơ sở dữ liệu',
                'slug' => Str::slug('Cơ sở dữ liệu'),
                'description' => 'Môn học về thiết kế cơ sở dữ liệu và SQL',
                'thumbnail' => null,
                'icon' => 'fa-solid fa-database',
                'color' => 'green',
                'status' => 'active',
                'faculty_id' => $cntt?->faculty_id,
                'created_by' => 1,
                'updated_by' => 1,
            ]
        );

        Subject::updateOrCreate(
            ['subject_code' => 'JAVA101'],
            [
                'subject_name' => 'Lập trình Java',
                'slug' => Str::slug('Lập trình Java'),
                'description' => 'Môn học Java cơ bản và hướng đối tượng',
                'thumbnail' => null,
                'icon' => 'fa-solid fa-mug-saucer',
                'color' => 'red',
                'status' => 'active',
                'faculty_id' => $cntt?->faculty_id,
                'created_by' => 1,
                'updated_by' => 1,
            ]
        );
    }
}