<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompKidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comp_kids', function (Blueprint $table) {
            $table->integer('comp_id')->unsigned()->nullable();
            $table->foreign('comp_id')->references('id')->on('competitions')->onDelete('cascade');
            $table->integer('kid_id')->unsigned()->nullable();
            $table->foreign('kid_id')->references('id')->on('kids')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comp_kids');
    }
}
