<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\instructor\AuthController;
//Route::get('/', function () {
//    return view('lucas.example.index');
//});

Route::get('/', [AuthController::class, 'index'])->name("login");
Route::post('/sign-out', [AuthController::class, 'signOut'])->name("signOut");

Route::prefix('api')->group(function () {
    Route::post('/login', [AuthController::class, 'attemptLogin'])->name("attemptLogin");
});

Route::prefix('instructor')->group(function () {
    Route::get('/', [AuthController::class, 'test'])->name("instructor.example.index");
});

