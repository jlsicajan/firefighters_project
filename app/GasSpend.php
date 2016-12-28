<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GasSpend extends Model
{
    protected $table = "gas_spends";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['unity_id', 'user_id' ,'bill_number', 'gas_name', 'gas_spend', 'note_gas'];
}
