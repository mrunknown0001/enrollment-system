<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMiscFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('misc_fees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 20)->nullable();
            $table->float('amount', 8,2)->nullable();
            $table->tinyInteger('type')->nullable(); // 1 for course, 2 for program, 3 for all
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
        Schema::dropIfExists('misc_fees');
    }
}
