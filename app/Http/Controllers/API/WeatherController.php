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

        $lat = $country->latitude ?? -6.2088;
        $lng = $country->longitude ?? 106.8456;

        $liveResult = $service->getWeather($lat, $lng);
        $cw = $liveResult['current_weather'] ?? null;

        $dbData = WeatherData::where('country_id', $country->id)->latest()->first();

        if ($cw) {
            $temp = round($cw['temperature'] ?? 25, 1);
            $wind = round($cw['windspeed'] ?? 10, 1);
            $wcode = (int) ($cw['weathercode'] ?? 0);
            $status = $this->interpretWeatherCode($wcode);
            $rain = $this->extractRainEstimate($wcode);
            $risk = $this->calculateRisk(['windspeed' => $wind, 'weathercode' => $wcode]);

            if ($dbData) {
                $dbData->update([
                    'temperature' => $temp,
                    'rain' => $rain,
                    'wind_speed' => $wind,
                    'weather_status' => $status,
                    'risk_level' => $risk,
                    'weather_code' => $wcode,
                ]);
            } else {
                $dbData = WeatherData::create([
                    'country_id' => $country->id,
                    'temperature' => $temp,
                    'rain' => $rain,
                    'wind_speed' => $wind,
                    'weather_status' => $status,
                    'risk_level' => $risk,
                    'weather_code' => $wcode,
                ]);
            }
        }

        $temperature = $dbData?->temperature ?? 28;
        $windSpeed = $dbData?->wind_speed ?? 12;
        $weatherStatus = $dbData?->weather_status ?? 'Berawan / Cloudy';
        $rainVal = $dbData?->rain ?? 0.0;
        $riskVal = $dbData?->risk_level ?? 'Low';
        $wCodeVal = $dbData?->weather_code ?? 0;

        return response()->json([
            'success' => true,
            'country' => $country->name,
            'weather' => [
                'temperature' => $temperature,
                'wind_speed' => $windSpeed,
                'weather_code' => $wCodeVal,
                'weather_status' => $weatherStatus,
                'rain' => $rainVal,
                'risk' => $riskVal
            ]
        ]);
    }

    private function calculateRisk($data)
    {
        $wind = $data['windspeed'] ?? 0;
        $code = $data['weathercode'] ?? 0;

        if ($wind > 40 || in_array($code, [95, 96, 99, 65, 82])) {
            return "High";
        }

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
        if (in_array($code, [95, 96, 99, 65, 82])) return 25.0;
        if (in_array($code, [61, 63, 80, 81])) return 10.0;
        if (in_array($code, [51, 53, 55])) return 2.5;
        return 0.0;
    }
}