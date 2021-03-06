<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('users');
            $table->integer('faculty_id')->unsigned()->nullable();
            $table->integer('subject_id')->unsigned();
            $table->integer('year_level_id')->unsigned()->nullable();
            $table->integer('academic_year_id')->unsigned()->nullable();
            $table->foreign('academic_year_id')->references('id')->on('academic_years');
            $table->integer('semester_id')->unsigned()->nullable();
            $table->foreign('semester_id')->references('id')->on('active_semesters');
            $table->integer('term_id')->unsigned()->nullable();
            $table->foreign('term_id')->references('id')->on('terms');
            $table->float('grade', 8,2);
            $table->string('remarks', 10)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grades');
    }
}
