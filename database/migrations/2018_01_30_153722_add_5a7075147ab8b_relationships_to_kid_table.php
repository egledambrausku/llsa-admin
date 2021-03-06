<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5a7075147ab8bRelationshipsToKidTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kids', function(Blueprint $table) {
            if (!Schema::hasColumn('kids', 'coach_id')) {
                $table->integer('coach_id')->unsigned()->nullable();
                $table->foreign('coach_id', '112963_5a7075127eaf8')->references('id')->on('coaches')->onDelete('cascade');
                }
                if (!Schema::hasColumn('kids', 'club_id')) {
                $table->integer('club_id')->unsigned()->nullable();
                $table->foreign('club_id', '112963_5a70751286164')->references('id')->on('clubs')->onDelete('cascade');
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
        Schema::table('kids', function(Blueprint $table) {
            
        });
    }
}
