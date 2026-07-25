<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\WeatherData;
use App\Services\WeatherService;

class WeatherController extends Controller
{
    public function show($code, WeatherService $service)
    {
        $country = Country::where('code', strtoupper($code))->first();

        if (!$country) {
            return response()->json([
                'message' => 'Country not found'
            ], 404);
        }

        $weather = $service->getWeather($country->latitude, $country->longitude);
        $current = $weather['current_weather'] ?? [
            'temperature' => 25.0,
            'windspeed' => 10.0,
            'weathercode' => 0
        ];

        $weatherCode = $current['weathercode'] ?? 0;
        $weatherStatus = $this->interpretWeatherCode($weatherCode);
        $rainMm = $this->extractRainEstimate($weatherCode);
        $risk = $this->calculateRisk($current);

        WeatherData::create([
            'country_id' => $country->id,
            'temperature' => $current['temperature'],
            'rain' => $rainMm,
            'wind_speed' => $current['windspeed'],
            'weather_status' => $weatherStatus,
            'risk_level' => $risk
        ]);

        return response()->json([
            'success' => true,
            'country' => $country->name,
            'weather' => [
                'temperature' => $current['temperature'],
                'wind_speed' => $current['windspeed'],
                'weather_code' => $weatherCode,
                'weather_status' => $weatherStatus,
                'rain' => $rainMm,
                'risk' => $risk
            ]
        ]);
    }

    private function calculateRisk($data)
    {
        $wind = $data['windspeed'] ?? 0;
        $code = $data['weathercode'] ?? 0;

        // Severe weather: Thunderstorm (95,96,99), Heavy Rain (65,82), High Winds (>40 km/h)
        if ($wind > 40 || in_array($code, [95, 96, 99, 65, 82])) {
            return "High";
        }

        // Moderate weather: Moderate Rain (53,55,61,63,80,81), Moderate Winds (>20 km/h)
        if ($wind > 20 || in_array($code, [53, 55, 61, 63, 80, 81])) {
            return "Medium";
        }

        return "Low";
    }

    private function interpretWeatherCode($code)
    {
        if (in_array($code, [95, 96, 99])) return 'Badai / Thunderstorm';
        if (in_array($code, [61, 63, 65, 80, 81, 82])) return 'Hujan / Rain';
        if (in_array($code, [51, 53, 55])) return 'Gerimis / Drizzle';
        if (in_array($code, [71, 73, 75, 77, 85, 86])) return 'Salju / Snow';
        if (in_array($code, [45, 48])) return 'Kabut / Fog';
        if (in_array($code, [1, 2, 3])) return 'Berawan / Cloudy';
        return 'Cerah / Clear';
    }

    private function extractRainEstimate($code)
    {
        if (in_array($code, [95, 96, 99, 65, 82])) return 25.0; // Heavy rain/storm
        if (in_array($code, [61, 63, 80, 81])) return 10.0;     // Moderate rain
        if (in_array($code, [51, 53, 55])) return 2.5;         // Light rain/drizzle
        return 0.0;
    }
}