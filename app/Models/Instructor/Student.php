<?php

namespace App\Models\Instructor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public $timestamps = false; // tells laravel to not expect 'created_at' and 'updated_at' fields to exist
    protected $guarded = []; // allows for mass insertion by setting the variable with guarded fields to an empty array
    protected $table = "student"; // tells laravel what the table is called in the database
    use HasFactory;

    // a student has many strip cards
    public function stripCards(){
        return $this->hasMany(StripCard::class, "student_id", "id");
    }

    // a student has many lessons
    public function lessons(){
        return $this->hasMany(Lesson::class, "student_id", "id");
    }
}
