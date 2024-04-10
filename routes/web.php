<?php

use App\Http\Controllers\Instructor\DashboardController;
use App\Http\Controllers\Instructor\LessonController;
use App\Http\Controllers\Instructor\StripCardController;
use App\Http\Controllers\Instructor\StudentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\instructor\AuthController;

// non authenticated routes
Route::get('/login', [AuthController::class, 'login'])->name("login");
Route::get('/', [DashboardController::class, 'index'])->name("instructor.dashboard.index");
Route::get('/contact', [DashboardController::class, 'contact'])->name("instructor.dashboard.contact");

// non authenticated api routes
Route::prefix('api')->group(function () {
    Route::post('/sign-out', [AuthController::class, 'signOut'])->name("signOut");
    Route::post('/login', [AuthController::class, 'attemptLogin'])->name("attemptLogin");
    Route::post('/contact', [DashboardController::class, 'storeContact'])->name("api.contact");
});

// authenticated routes
Route::middleware(['authenticated'])->group(function () {
    // instructor routes
    Route::middleware(['role:instructor'])->group(function () {
        Route::prefix('instructor')->group(function () {
            Route::prefix('strip-card')->group(function () {
                Route::get('/', [StripCardController::class, 'index'])->name("instructor.strip_card.index");
                Route::get('/new', [StripCardController::class, 'new'])->name("instructor.strip_card.new");
                Route::get('/edit/{id}', [StripCardController::class, 'edit'])->name("instructor.strip_card.edit");
            });

            Route::prefix('student')->group(function () {
                Route::get('/', [StudentController::class, 'index'])->name("instructor.student.index");
                Route::get('/show/{id}', [StudentController::class, 'show'])->name("instructor.student.show");
            });

            Route::prefix('lesson')->group(function () {
                Route::get('/', [LessonController::class, 'index'])->name("instructor.lesson.index");
                Route::get('/personal', [LessonController::class, 'personal'])->name("instructor.lesson.personal");
                Route::get('/edit/{id}', [LessonController::class, 'edit'])->name("instructor.lesson.edit");
            });

            // authenticated api routes
            Route::prefix('api')->group(function () {
                Route::prefix('strip-card')->group(function () {
                    Route::post('/store', [StripCardController::class, 'store'])->name("instructor.api.strip_card.store");
                    Route::post('/update/{id}', [StripCardController::class, 'update'])->name("instructor.api.strip_card.update");
                    Route::put('/delete/{id}', [StripCardController::class, 'delete'])->name("instructor.api.strip_card.delete");
                });
                Route::prefix('lesson')->group(function () {
                    Route::post('/store/{id}', [LessonController::class, 'update'])->name("instructor.api.lesson.update");
                    Route::put('/finish/{id}', [LessonController::class, 'finish'])->name("instructor.api.lesson.finish");
                });
            });
        });
    });
});


