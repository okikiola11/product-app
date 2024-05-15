<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CreateCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = [
            [
                'title' => 'Computer Science',
                'unit' => '4',
                'description' => 'Introduction to computing',
            ],
            [
                'title' => 'Political Science',
                'unit' => '2',
                'description' => 'Introduction to political science',
            ],
            [
                'title' => 'Mathematics',
                'unit' => '3',
                'description' => 'Theories and Formulas of Algebra',
            ],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
