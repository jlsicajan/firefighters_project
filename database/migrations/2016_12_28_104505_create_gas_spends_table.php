<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGasSpendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gas_spends', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('unity_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->text('bill_number');
            $table->text('gas_name');
            $table->integer('gas_spend');
            $table->longText('note_gas');

            $table->timestamps();

            $table->foreign('unity_id')->references('id')->on('unities');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gas_spends');
    }
}
