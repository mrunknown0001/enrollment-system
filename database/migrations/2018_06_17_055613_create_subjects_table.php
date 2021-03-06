<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->increments('id');
            // $table->string('title')->nullable();
            $table->string('code', 10)->nullable();
            $table->string('description', 150)->nullable();
            $table->integer('units')->nullable();
            $table->integer('hours')->nullable();
            $table->integer('year_level')->nullable();
            $table->integer('semester')->nullable();
            $table->integer('prerequisites')->nullable();
            $table->tinyInteger('active')->default(0);
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
        Schema::dropIfExists('subjects');
    }
}
