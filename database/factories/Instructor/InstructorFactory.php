<?php

namespace Database\Factories\Instructor;

use App\Models\Instructor\Instructor;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends Factory<Instructor>
 */
class InstructorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    //generates fake instructors
    public function definition(): array
    {
        $faker = Faker::create('nl_NL');

        return [
            "first_name" => $faker->firstName,
            "sir_name" => $faker->lastName,
            "email" => $faker->email,
            "password" => $faker->sha256,
            "is_admin" => 0,
        ];
    }
}
