<?php

use App\Http\Controllers\Instructor\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\instructor\AuthController;

Route::get('/', [AuthController::class, 'index'])->name("login");
Route::post('/sign-out', [AuthController::class, 'signOut'])->name("signOut");

Route::prefix('api')->group(function () {
    Route::post('/login', [AuthController::class, 'attemptLogin'])->name("attemptLogin");
});

Route::prefix('instructor')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name("instructor.example.index");
    Route::get('/contact', [DashboardController::class, 'contact'])->name("instructor.example.contact");

//    Route::prefix('instructor')->group(function () {
//
//    }
});

