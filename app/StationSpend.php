<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StationSpend extends Model
{
    protected $table = "station_spends";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id' ,'bill_number', 'station_spend', 'description', 'path_photo'];

}
