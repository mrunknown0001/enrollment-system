<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('program_id')->unsigned()->nullable();
            $table->foreign('program_id')->references('id')->on('programs');
            $table->integer('course_id')->unsigned()->nullable();
            $table->foreign('course_id')->references('id')->on('courses');
            $table->string('subject_ids')->nullable();
            $table->integer('semester_id')->unsigned()->nullable();
            $table->integer('year_level_id')->unsigned()->nullable();
            $table->integer('academic_year_id')->unsigned()->nullable();
            $table->tinyInteger('paid')->default(0);
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
        Schema::dropIfExists('assessments');
    }
}
