<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up():void
    {
        Schema::create('course_student', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(\App\Models\Student::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Course::class)->constrained()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down():void
    {
        Schema::dropIfExists('course_student');
    }
}
