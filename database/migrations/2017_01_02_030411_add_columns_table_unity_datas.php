<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsTableUnityDatas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('unity_datas', function (Blueprint $table) {
            $table->longText('observations')->nullable();
            $table->integer('asistant_id_two')->nullable()->unsigned();
            $table->integer('asistant_id_three')->nullable()->unsigned();

            $table->foreign('asistant_id_two')->references('id')->on('users');
            $table->foreign('asistant_id_three')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('unity_datas', function (Blueprint $table) {
            $table->dropColumn('observations');
            $table->dropColumn('asistant_id_two');
            $table->dropColumn('asistant_id_three');
        });
    }
}
