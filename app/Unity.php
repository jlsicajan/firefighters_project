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
    protected $fillable = ['name', 'code', 'image_url'];

    public static function findByCode($code){
        return Unity::where('code', '=', $code)->first()->toArray();
    }
    public static function findNameByCode($code){
        $unity = Unity::where('code', '=', $code)->first()->toArray();
        return $unity['name'];
    }
    public static function getNameById($id){
        $unity = Unity::where('id', '=', $id)->select('name')->first();
        return ltrim($unity['name'], 'UNIDAD');
    }
}
