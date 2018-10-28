<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname', 40);
            $table->string('lastname', 40);
            $table->string('gender', 6)->nullable();
            $table->string('username', 32)->unique();
            $table->string('id_number', 10)->unique();
            $table->string('mobile_number', 11)->nullable();
            $table->string('password', 75);
            $table->tinyInteger('active')->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists('registrars');
    }
}
