<?php

namespace App\Models\Instructor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StripCard extends Model
{
    public $timestamps = false; // tells laravel to not expect 'created_at' and 'updated_at' fields to exist
    protected $guarded = []; // allows for mass insertion by setting the variable with guarded fields to an empty array
    protected $table = "strip_card"; // tells laravel what the table is called in the database
    use HasFactory;

    // a strip card has one student
    public function student(){
        return $this->hasOne(Student::class, "id", "student_id");
    }
}
