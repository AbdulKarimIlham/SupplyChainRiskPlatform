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
            $status = ['Sunny', 'Cloudy', 'Rainy', 'Stormy'][rand(0, 3)];
            $riskLevel = $status === 'Stormy' ? 'high' : ($status === 'Rainy' ? 'medium' : 'low');

            $records[] = [
                'country_id' => $country->id,
                'temperature' => rand(10, 35),
                'rain' => rand(0, 200) / 10,
                'wind_speed' => rand(0, 25),
                'weather_status' => $status,
                'risk_level' => $riskLevel,
                'weather_code' => rand(100, 999),
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        WeatherData::insert($records);
    }
}