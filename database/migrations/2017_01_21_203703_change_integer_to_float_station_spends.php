<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeIntegerToFloatStationSpends extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('station_spends', function ($table) {
            $table->float('station_spend')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //THIS HAS NOT DOWN BECAUSE IT JUST CHANGE THE TYPE OF THE COLUMN STATION_SPEND AND NOT NECESSARY TO DELETE THE COLUMN
        //BEACUSE IT IS DELETE WHEN THE TABLE IS DELETED IN THE PRINCIPAL MIGRATION
    }
}
