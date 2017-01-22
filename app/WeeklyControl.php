<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WeeklyControl extends Model
{
    protected $table = "weekly_controls";

    protected $fillable = ['reintegrate', 'gain'];
    protected $dates = ['date_from', 'date_to'];
}
