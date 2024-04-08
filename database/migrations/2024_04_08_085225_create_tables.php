<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('first_name', 50);
            $table->string('sir_name', 70);
            $table->string('address', 100);
            $table->string('zipcode', 6);
            $table->string('city', 30);
            $table->string('phone', 30);
            $table->string('email', 100);
            $table->string('password', 255);
            $table->boolean('active')->default(true);
        });

        Schema::create('lesson', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('car_id')->nullable()->index('lesson-fk1');
            $table->integer('student_id')->nullable()->index('lesson-fk2');
            $table->integer('instructor_id')->nullable()->index('lesson-fk3');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->boolean('active')->default(true);
        });

        Schema::create('car', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('plate', 12);
            $table->string('brand',30);
            $table->string('model', 50);
            $table->string('fuel', 30);
            $table->boolean('cruise_control');
            $table->boolean('active')->default(true);
        });

        Schema::create('instructor', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('first_name', 12);
            $table->string('sir_name', 50);
            $table->string('password', 255);
            $table->string('email', 100);
            $table->boolean('is_admin');
            $table->boolean('active')->default(true);
        });

        Schema::create('strip_card', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('student_id')->index('strip_card-fk1');
            $table->integer('lessons');
            $table->integer('remaining');
            $table->boolean('active')->default(true);
        });

        Schema::table('strip_card', function (Blueprint $table) {
            $table->foreign(['student_id'], 'strip_card-fk1')->references(['id'])->on('student')->onUpdate('restrict')->onDelete('restrict');
        });

        Schema::table('lesson', function (Blueprint $table) {
            $table->foreign(['student_id'], 'lesson-fk1')->references(['id'])->on('student')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['car_id'], 'lesson-fk2')->references(['id'])->on('car')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['instructor_id'], 'lesson-fk3')->references(['id'])->on('instructor')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('strip_card');
        Schema::dropIfExists('student');
        Schema::dropIfExists('lesson');
        Schema::dropIfExists('car');
        Schema::dropIfExists('instructor');

        Schema::table('strip_card', function (Blueprint $table) {
            $table->dropForeign('strip_card-fk1');
        });

        Schema::table('strip_card', function (Blueprint $table) {
            $table->dropForeign('lesson-fk1');
            $table->dropForeign('lesson-fk2');
            $table->dropForeign('lesson-fk3');
        });
    }
};
