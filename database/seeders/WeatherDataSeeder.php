<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WeatherData;
use App\Models\Country;

class WeatherDataSeeder extends Seeder
{
    public function run(): void
    {
        $countries = Country::all();
        $now = now();
        $records = [];

        foreach ($countries as $country) {
            $code = strtoupper($country->code);
            $region = strtolower($country->region ?? '');

            if (in_array($code, ['IDN', 'SGP', 'MYS', 'THA', 'PHL', 'VNM'])) {
                $temp = 30;
                $status = 'Cerah / Clear';
                $riskLevel = 'Low';
                $wind = 12;
                $rain = 2.0;
            } elseif ($region === 'asia') {
                $temp = 28;
                $status = 'Berawan / Cloudy';
                $riskLevel = 'Low';
                $wind = 15;
                $rain = 0.0;
            } elseif ($region === 'europe') {
                $temp = 20;
                $status = 'Berawan / Cloudy';
                $riskLevel = 'Low';
                $wind = 18;
                $rain = 1.0;
            } else {
                $temp = 25;
                $status = 'Cerah / Clear';
                $riskLevel = 'Low';
                $wind = 10;
                $rain = 0.0;
            }

            $records[] = [
                'country_id' => $country->id,
                'temperature' => $temp,
                'rain' => $rain,
                'wind_speed' => $wind,
                'weather_status' => $status,
                'risk_level' => $riskLevel,
                'weather_code' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        WeatherData::insert($records);
    }
}