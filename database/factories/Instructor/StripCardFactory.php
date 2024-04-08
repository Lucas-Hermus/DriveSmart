<?php

namespace Database\Factories\Instructor;

use App\Models\Instructor\StripCard;
use App\Models\Instructor\Student;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<StripCard>
 */
class StripCardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $student_id = Student::inRandomOrder()->first()->id;
        $lessons = [10, 20, 30, 25][rand(0,3)];
        return [
            "student_id" => $student_id,
            "lessons" => $lessons,
            "remaining" => $lessons - rand(0, $lessons),
        ];
    }
}
