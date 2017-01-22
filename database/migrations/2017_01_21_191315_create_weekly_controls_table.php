<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeeklyControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weekly_controls', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('date_from');
            $table->dateTime('date_to');
            $table->float('reintegrate')->default(00.00);
            $table->float('gain')->default(00.00);
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
        Schema::dropIfExists('weekly_controls');
    }
}
