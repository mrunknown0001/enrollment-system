<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 50)->nullable();
            $table->string('code', 10)->nullable();
            $table->string('description', 70)->nullable();
            $table->date('from')->nullable();
            $table->date('to')->nullable();
            $table->integer('hours')->nullable();
            $table->float('tuition_fee', 8, 2);
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
        Schema::dropIfExists('programs');
    }
}
