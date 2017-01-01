<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnityDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unity_datas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('date');
            $table->string('timeout');
            $table->string('timein');
            $table->string('kmout');
            $table->string('kmin');
            $table->string('patient_name')->nullable();
            $table->string('patient_responsible')->nullable();
            $table->string('patient_age');
            $table->longText('patient_case');
            $table->string('patient_address');
            $table->string('patient_address_from');
            $table->string('patient_destiny');
            $table->integer('patient_phone')->nullable();
            $table->integer('patient_input')->nullable();
            $table->integer('asistant_id')->nullable()->unsigned();
            $table->integer('pilot_id')->unsigned();
            $table->integer('unity_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('general_case');

            $table->foreign('asistant_id')->references('id')->on('users');
            $table->foreign('pilot_id')->references('id')->on('users');
            $table->foreign('unity_id')->references('id')->on('unities');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('unity_datas');
    }
}
