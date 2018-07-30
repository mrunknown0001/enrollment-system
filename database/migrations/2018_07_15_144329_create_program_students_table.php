<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_students', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('users');
            $table->integer('academic_year_id')->unsigned();
            $table->integer('semester')->unsigned();
            $table->integer('program_id')->unsigned();
            $table->integer('group_number')->nullable(); // group number depends on ay, ly, sem, subject limit
            $table->integer('number_of_students')->nullable();
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
        Schema::dropIfExists('program_students');
    }
}
