<?php

namespace Database\Factories\Instructor;

use App\Models\Instructor\Car;
use App\Models\Instructor\Instructor;
use App\Models\Instructor\Student;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Instructor\Lesson>
 */
class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = Faker::create('nl_NL');
        $filled = $faker->boolean;
        $start = Carbon::now()->addDays(rand(-7, 7))->addMinutes(rand(-86400, 86400));
        $instructorId = Instructor::inRandomOrder()->first()->id;
        $carId = Car::inRandomOrder()->first()->id;
        $student_id = Student::inRandomOrder()->first()->id;
        return [
            "instructor_id" => $filled ? $instructorId : null,
            "car_id" => $filled ? $carId : null,
            "student_id" => $filled ? $student_id : null,
            "start" => $start,
            "end" => $start->addhour(1),
        ];
    }
}
