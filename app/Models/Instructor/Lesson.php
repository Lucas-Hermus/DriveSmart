<?php

namespace App\Models\Instructor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    public $timestamps = false; // tells laravel to not expect 'created_at' and 'updated_at' fields to exist
    protected $guarded = []; // allows for mass insertion by setting the variable with guarded fields to an empty array
    protected $table = "lesson"; // tells laravel what the table is called in the database
    use HasFactory;

    // a lesson has one car
    public function car(){
        return $this->hasOne(Car::class, "id", "car_id");
    }

    // a lesson has one instructor
    public function instructor(){
        return $this->hasOne(Instructor::class, "id", "instructor_id");
    }

    // a lesson has one student
    public function student(){
        return $this->hasOne(Student::class, "id", "student_id");
    }
}
