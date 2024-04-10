<?php

namespace App\Models\Instructor;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as AuthenticatableUser;

class Student extends AuthenticatableUser implements Authenticatable
{
    public $timestamps = false; // tells laravel to not expect 'created_at' and 'updated_at' fields to exist
    protected $guarded = []; // allows for mass insertion by setting the variable with guarded fields to an empty array
    protected $table = "student"; // tells laravel what the table is called in the database
    use HasFactory;

    // a student has many strip cards
    public function stripCards()
    {
        return $this->hasMany(StripCard::class, "student_id", "id");
    }

    // a student has many lessons
    public function lessons()
    {
        return $this->hasMany(Lesson::class, "student_id", "id");
    }

    // calculates the total balance of all stripcards combined from the student
    public function calcuateStripCardBalance()
    {
        $balance = 0;
        // loop through all stripcards
        foreach ($this->stripCards as $stripCard) {
            if (!$stripCard->active) {
                continue;
            }
            $balance += $stripCard->remaining; // add the remaining balance to a total
        }
        return $balance;
    }

    // gets the first stripcard that has a remaining balance (1 or more)
    // returns null if no stripcards fit this description
    public function firstNonEmptyStripCard()
    {
        // loop through stripcards and return the first one that matches
        foreach ($this->stripCards as $stripCard) {
            if ($stripCard->remaining > 0) {
                return $stripCard;
            }
        }
        return null; // return null if no matches are found
    }
}
