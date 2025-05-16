<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\Student;
use App\Models\Instructor;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class LessonSeeder extends Seeder
{
    public function run(): void
    {
        $students = Student::all();
        $instructors = Instructor::all();
        $vehicles = Vehicle::all();

        if ($students->isEmpty() || $instructors->isEmpty() || $vehicles->isEmpty()) {
            return;
        }

        $lessons = [
            [
                'student_id' => $students->first()->id,
                'instructor_id' => $instructors->first()->id,
                'vehicle_id' => $vehicles->first()->id,
                'start_time' => Carbon::now()->addDay()->setHour(9)->setMinute(0),
                'duration' => 60, // 1 heure
                'type' => 'conduite',
                'status' => 'scheduled',
                'notes' => 'Première leçon de conduite',
            ],
            [
                'student_id' => $students->first()->id,
                'instructor_id' => $instructors->first()->id,
                'vehicle_id' => $vehicles->first()->id,
                'start_time' => Carbon::now()->addDays(2)->setHour(14)->setMinute(0),
                'duration' => 90, // 1h30
                'type' => 'conduite',
                'status' => 'scheduled',
                'notes' => 'Leçon de conduite en ville',
            ],
            [
                'student_id' => $students->last()->id,
                'instructor_id' => $instructors->last()->id,
                'vehicle_id' => $vehicles->last()->id,
                'start_time' => Carbon::now()->addDays(3)->setHour(10)->setMinute(30),
                'duration' => 45, // 45 minutes
                'type' => 'code',
                'status' => 'scheduled',
                'notes' => 'Leçon de code',
            ],
        ];

        foreach ($lessons as $lesson) {
            Lesson::create($lesson);
        }
    }
} 