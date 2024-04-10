<?php

namespace Database\Seeders;

use App\Models\Instructor\Car;
use App\Models\Instructor\Instructor;
use App\Models\Instructor\Lesson;
use App\Models\Instructor\StripCard;
use App\Models\Instructor\Student;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('instructor')->insert([
            "first_name" => 'instructor',
            "sir_name" => 'instructor',
            "email" => "instructor@instructor.com",
            "is_admin" => false,
            "password" => Hash::make("instructor"),
        ]);

        DB::table('instructor')->insert([
            "first_name" => 'admin',
            "sir_name" => 'admin',
            "email" => "admin@admin.com",
            "is_admin" => true,
            "password" => Hash::make("admin"),
        ]);

        DB::table('student')->insert([
            "first_name" => "student",
            "sir_name" => "student",
            "address" => "-",
            "zipcode" => "4032TD",
            "city" => "Roermond",
            "phone" => "0612345678",
            "email" => "student@student.com",
            "password" => Hash::make("student"),
        ]);

        DB::table('car')->insert([
            'plate' => "MF-JX-9-GJ-8",
            'brand' => 'BMW',
            'model' => "GT",
            'fuel' => "elektrisch",
            'cruise_control' => rand(0,1)
        ]);
        DB::table('car')->insert([
            'plate' => "KR-WJ-9-LU-1",
            'brand' => 'Lexus',
            'model' => "323",
            'fuel' => "elektrisch",
            'cruise_control' => rand(0,1)
        ]);
        DB::table('car')->insert([
            'plate' => "KR-WJ-9-LU-1",
            'brand' => 'Lexus',
            'model' => "323",
            'fuel' => "benzine",
            'cruise_control' => rand(0,1)
        ]);

//        Car::factory()->times(100)->create();
        Student::factory()->times(100)->create();
        Instructor::factory()->times(3)->create();
        StripCard::factory()->times(100)->create();
        Lesson::factory()->times(300)->create();
    }
}
