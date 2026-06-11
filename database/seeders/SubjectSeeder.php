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

        $subjects = [
            [
                'subject_code' => 'WEB101',
                'subject_name' => 'Lập trình Web',
                'description' => 'Môn học phát triển website bằng HTML, CSS, JavaScript và Laravel',
                'icon' => 'fa-solid fa-globe',
                'color' => 'blue',
            ],
            [
                'subject_code' => 'DB101',
                'subject_name' => 'Cơ sở dữ liệu',
                'description' => 'Môn học về thiết kế cơ sở dữ liệu và SQL',
                'icon' => 'fa-solid fa-database',
                'color' => 'green',
            ],
            [
                'subject_code' => 'JAVA101',
                'subject_name' => 'Lập trình Java',
                'description' => 'Môn học Java cơ bản và hướng đối tượng',
                'icon' => 'fa-solid fa-mug-saucer',
                'color' => 'red',
            ],
        ];

        foreach ($subjects as $subject) {
            Subject::updateOrCreate(
                [
                    'subject_code' => $subject['subject_code'],
                ],
                [
                    'subject_name' => $subject['subject_name'],
                    'slug' => Str::slug($subject['subject_name']),
                    'description' => $subject['description'],
                    'thumbnail' => null,
                    'icon' => $subject['icon'],
                    'color' => $subject['color'],
                    'status' => 'active',
                    'faculty_id' => $cntt?->faculty_id,
                    'created_by' => 1,
                    'updated_by' => 1,
                ]
            );
        }
    }
}