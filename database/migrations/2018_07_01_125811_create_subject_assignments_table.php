<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_assignments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('faculty_id')->unsigned();
            $table->foreign('faculty_id')->references('id')->on('faculties');
            $table->integer('academic_year_id')->unsigned();
            $table->integer('semester_id')->unsigned();
            $table->string('subject_ids', 150);
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
        Schema::dropIfExists('subject_assignments');
    }
}
