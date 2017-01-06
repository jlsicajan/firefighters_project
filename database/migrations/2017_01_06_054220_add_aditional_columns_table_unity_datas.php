<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAditionalColumnsTableUnityDatas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('unity_datas', function (Blueprint $table) {
            $table->string('service_type');

            $table->string('water_destiny');
            $table->string('water_spend');
            $table->string('fill_unity');
            $table->string('spend_aport');
            $table->integer('fill_spend');
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
            $table->dropColumn('service_type');

            $table->dropColumn('water_destiny');
            $table->dropColumn('water_spend');
            $table->dropColumn('fill_unity');
            $table->dropColumn('fill_unity');
            $table->dropColumn('spend_aport');
        });
    }
}
