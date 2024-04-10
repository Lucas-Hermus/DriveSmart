<?php

namespace Database\Factories\Instructor;

use App\Models\Instructor\Student;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    //geneartes fake students
    public function definition(): array
    {
        $faker = Faker::create('nl_NL');

        return [
            "first_name" => $faker->firstName,
            "sir_name" => $faker->lastName,
            "address" => $faker->address,
            "zipcode" => $faker->postcode,
            "city" => $faker->city,
            "phone" => $faker->phoneNumber,
            "email" => $faker->email,
            "password" => $faker->sha256,
        ];
    }
}
