<?php

use App\Http\Controllers\Instructor\DashboardController;
use App\Http\Controllers\Instructor\LessonController;
use App\Http\Controllers\Instructor\StripCardController;
use App\Http\Controllers\Instructor\StudentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\instructor\AuthController;

Route::get('/', [AuthController::class, 'index'])->name("login");
Route::post('/sign-out', [AuthController::class, 'signOut'])->name("signOut");

Route::prefix('api')->group(function () {
    Route::post('/login', [AuthController::class, 'attemptLogin'])->name("attemptLogin");
});

Route::prefix('instructor')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name("instructor.dashboard.index");
    Route::get('/contact', [DashboardController::class, 'contact'])->name("instructor.dashboard.contact");

    Route::prefix('strip-card')->group(function () {
        Route::get('/', [StripCardController::class, 'index'])->name("instructor.strip_card.index");
        Route::get('/new', [StripCardController::class, 'new'])->name("instructor.strip_card.new");
        Route::get('/edit/{id}', [StripCardController::class, 'edit'])->name("instructor.strip_card.edit");
    });

    Route::prefix('student')->group(function () {
        Route::get('/', [StudentController::class, 'index'])->name("instructor.student.index");
        Route::get('/edit/{id}', [StripCardController::class, 'edit'])->name("instructor.student.edit");
    });

    Route::prefix('lesson')->group(function () {
        Route::get('/', [LessonController::class, 'index'])->name("instructor.lesson.index");
        Route::get('/edit/{id}', [StripCardController::class, 'edit'])->name("instructor.lesson.edit");
    });

    Route::prefix('api')->group(function (){
        Route::prefix('strip-card')->group(function () {
            Route::post('/store', [StripCardController::class, 'store'])->name("instructor.api.strip_card.store");
        });
    });

});

