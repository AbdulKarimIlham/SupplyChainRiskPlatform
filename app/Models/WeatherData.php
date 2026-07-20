<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class WeatherData extends Model
{


    protected $fillable = [

        'country_id',

        'temperature',

        'rain',

        'wind_speed',

        'weather_status',

        'risk_level'

    ];



    public function country()
    {

        return $this->belongsTo(
            Country::class
        );

    }


}