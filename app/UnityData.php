<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnityData extends Model
{
    protected $table = "unity_datas";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['date', 'timeout', 'timein', 'kmout', 'kmin', 'patient_name', 'patient_responsible',
                            'patient_age', 'patient_case', 'patient_address', 'patient_address_from',
                            'patient_destiny', 'patient_phone', 'patient_input', 'asistant_id', 'pilot_id', 'unity_id', 'user_id', 'general_case',
                            'observations', 'asistant_id_two', 'asistant_id_three'];
}
