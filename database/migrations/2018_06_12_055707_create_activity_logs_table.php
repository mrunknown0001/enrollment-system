<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('student_id')->unsigned()->nullable();
            $table->foreign('student_id')->references('id')->on('users');
            
            $table->integer('admin_id')->unsigned()->nullable();
            $table->foreign('admin_id')->references('id')->on('admins');
            
            $table->integer('facutly_id')->unsigned()->nullable();
            $table->foreign('facutly_id')->references('id')->on('faculties');
            
            $table->integer('cashier_id')->unsigned()->nullable();
            $table->foreign('cashier_id')->references('id')->on('cashiers');
            
            $table->integer('registrar_id')->unsigned()->nullable();
            $table->foreign('registrar_id')->references('id')->on('registrars');

            $table->tinyInteger('user_type')->default(5); // 1 for admin, 2 for facutly, 3 for cashier, 4 for registrar, 5 for students
            $table->string('action', 100)->nullable();
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
        Schema::dropIfExists('activity_logs');
    }
}
