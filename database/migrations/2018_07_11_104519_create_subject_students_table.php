<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_students', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('users');
            $table->integer('academic_year_id')->unsigned();
            $table->integer('semester')->unsigned();
            $table->integer('year_level_id')->unsigned();
            $table->integer('subject_id')->unsigned();
            $table->integer('group_number'); // group number depends on ay, ly, sem, subject limit
            $table->integer('number_of_students'); // incremented depends on the last number and the limit of students per subject class
            $table->tinyInteger('active')->default(1);
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
        Schema::dropIfExists('subject_students');
    }
}
