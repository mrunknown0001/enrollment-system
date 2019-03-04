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
            $table->integer('year_level')->unsigned()->nullable();
            $table->foreign('year_level')->references('id')->on('year_levels');
            $table->tinyInteger('enrolling_for')->nullable(); // 1 for coruse, 2 program
            $table->integer('course_id')->unsigned()->nullable();
            $table->foreign('course_id')->references('id')->on('courses');
            $table->integer('program_id')->unsigned()->nullable();
            $table->foreign('program_id')->references('id')->on('programs');
            $table->tinyInteger('graduated')->default(0);
            $table->tinyInteger('regular')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('place_of_birth', 50)->nullable();
            $table->string('address', 50)->nullable();
            $table->string('nationality', 15)->nullable();
            $table->string('academic_program', 10)->nullable();
            $table->integer('school_year_admitted')->nullable();
            $table->string('category', 20)->nullable();
            $table->string('school_last_attended', 100)->nullable();
            $table->string('date_graduated', 20)->nullable();
            $table->integer('mop_id')->unsigned()->nullable();
            $table->foreign('mop_id')->references('id')->on('mode_of_payments');
            $table->tinyInteger('enrolled')->default(1);
            // requirements part
            $table->tinyInteger('student_eroll_type')->default(1); // 1 for new enrollee, 2 for transferee
            $table->boolean('form_138_als')->default(0)->nullable();
            $table->boolean('transfer_credentials')->default(0)->nullable();
            $table->boolean('copy_of_grades')->default(0)->nullable();
            $table->boolean('cert_good_moral_char')->default(0)->nullable();
            $table->boolean('birth_certificate')->default(0)->nullable();
            $table->boolean('marriage_certificate')->default(0)->nullable();
            $table->boolean('pictures')->default(0)->nullable();
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
