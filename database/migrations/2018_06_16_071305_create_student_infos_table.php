<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('users');
            $table->integer('year_level')->nullable();
            $table->tinyInteger('enrolling_for')->nullable(); // 1 for coruse, 2 program
            $table->integer('course_id')->nullable();
            $table->integer('program_id')->nullable();
            $table->tinyInteger('graduated')->default(0);
            $table->tinyInteger('regular')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->string('address')->nullable();
            $table->string('nationality')->nullable();
            $table->string('academic_program')->nullable();
            $table->integer('school_year_admitted')->nullable();
            $table->string('category')->nullable();
            $table->string('school_last_attended')->nullable();
            $table->string('date_graduated')->nullable();
            $table->integer('mop_id')->unsigned()->nullable();
            $table->foreign('mop_id')->references('id')->on('mode_of_payments');
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
        Schema::dropIfExists('student_infos');
    }
}
