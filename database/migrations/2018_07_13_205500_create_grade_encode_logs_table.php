<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradeEncodeLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grade_encode_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('faculty_id')->unsigned();
            $table->foreign('faculty_id')->references('id')->on('faculties');
            $table->integer('academic_year_id')->unsigned();
            $table->integer('semester_id')->unsigned();
            $table->integer('year_level_id')->unsigned();
            $table->integer('subject_id')->unsigned();
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
        Schema::dropIfExists('grade_encode_logs');
    }
}
