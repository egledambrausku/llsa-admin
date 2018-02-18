<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1517321732CompetitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('competitions', function (Blueprint $table) {
            if(Schema::hasColumn('competitions', 'date')) {
                $table->dropColumn('date');
            }
            if(Schema::hasColumn('competitions', 'data')) {
                $table->dropColumn('data');
            }
            
        });
Schema::table('competitions', function (Blueprint $table) {
            
if (!Schema::hasColumn('competitions', 'date')) {
                $table->date('date')->nullable();
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
        Schema::table('competitions', function (Blueprint $table) {
            $table->dropColumn('date');
            
        });
Schema::table('competitions', function (Blueprint $table) {
                        $table->datetime('date')->nullable();
                
        });

    }
}
