<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Unity extends Model
{
    protected $table = "unities";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'code'];

    public static function findByCode($code){
        return Unity::where('code', '=', $code)->first()->toArray();
    }

}
