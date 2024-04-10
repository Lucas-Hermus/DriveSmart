<?php

namespace App\Models\Instructor;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as AuthenticatableUser;

class Instructor extends AuthenticatableUser implements Authenticatable
{
    public $timestamps = false; // tells laravel to not expect 'created_at' and 'updated_at' fields to exist
    protected $guarded = []; // allows for mass insertion by setting the variable with guarded fields to an empty array
    protected $table = "instructor"; // tells laravel what the table is called in the database
    use HasFactory;

    // an instructor has many lessons
    public function lessons()
    {
        return $this->hasMany(Lesson::class, "instructor_id", "id");
    }
}
