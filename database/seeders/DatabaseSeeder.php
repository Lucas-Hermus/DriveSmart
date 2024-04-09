<?php

namespace Database\Seeders;

use App\Models\Instructor\Car;
use App\Models\Instructor\Instructor;
use App\Models\Instructor\Lesson;
use App\Models\Instructor\StripCard;
use App\Models\Instructor\Student;
use Database\Factories\Instructor\LessonFactory;
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
        DB::table('instructor')->insert([
            "first_name" => 'a',
            "sir_name" => 'a',
            "email" => "a@a.com",
            "is_admin" => true,
            "password" => Hash::make("a"),
        ]);


        Car::factory()->times(100)->create();
        Student::factory()->times(100)->create();
        Instructor::factory()->times(4)->create();
        StripCard::factory()->times(100)->create();
        Lesson::factory()->times(300)->create();
    }
}
