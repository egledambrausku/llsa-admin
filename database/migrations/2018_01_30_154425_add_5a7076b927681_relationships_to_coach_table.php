<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5a7076b927681RelationshipsToCoachTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coaches', function(Blueprint $table) {
            if (!Schema::hasColumn('coaches', 'club_id')) {
                $table->integer('club_id')->unsigned()->nullable();
                $table->foreign('club_id', '112956_5a7072c249349')->references('id')->on('clubs')->onDelete('cascade');
                }
                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coaches', function(Blueprint $table) {
            
        });
    }
}
