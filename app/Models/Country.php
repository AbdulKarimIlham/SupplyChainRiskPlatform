<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{


    protected $fillable = [

        'name',

        'code',

        'region',

        'currency',

        'language',

        'latitude',

        'longitude'

    ];

    public function weather()
{

    return $this->hasMany(
        WeatherData::class
    );

}

public function economy()
{

    return $this->hasMany(
        EconomicData::class
    );

}

public function currency()
{

    return $this->hasMany(
    CurrencyRate::class
    );

}

public function riskScores()
{

return $this->hasMany(
RiskScore::class
);

}

public function riskHistories()
{

    return $this->hasMany(
        RiskHistory::class
    );

}

}