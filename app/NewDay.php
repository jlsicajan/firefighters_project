<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewDay extends Model
{
    protected $table = "new_days";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id' ,'date', 'news_day'];
}
