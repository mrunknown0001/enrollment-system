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
            $table->integer('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('users');
            $table->string('assessment_number', 20)->nullable();
            $table->integer('program_id')->unsigned()->nullable();
            $table->integer('course_id')->unsigned()->nullable();
<<<<<<< HEAD
            $table->string('subject_ids', 60)->nullable();
=======
            $table->string('subject_ids', 70)->nullable();
>>>>>>> 9827113e102b500327ce11649c815eb2a32a31fc
            $table->integer('semester_id')->unsigned()->nullable();
            $table->integer('year_level_id')->unsigned()->nullable();
            $table->integer('academic_year_id')->unsigned()->nullable();
            $table->float('tuition_fee', 8, 2)->nullable();
            $table->float('misc_fee', 8, 2)->nullable();
            $table->float('total', 8, 2)->nullable();
            $table->float('total_paid', 8, 2)->nullable();
            $table->tinyInteger('paid')->default(0);
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
        Schema::dropIfExists('assessments');
    }
}
