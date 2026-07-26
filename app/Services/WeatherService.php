<?php

namespace App\Services;


use Illuminate\Support\Facades\Http;



class WeatherService
{


    public function getWeather($latitude, $longitude)
    {
        try {
            $response = Http::timeout(4)->get('https://api.open-meteo.com/v1/forecast', [
                'latitude' => $latitude,
                'longitude' => $longitude,
                'current_weather' => true,
                'hourly' => 'rain'
            ]);

            if ($response->successful()) {
                return $response->json();
            }
        } catch (\Throwable $e) {
            // Silence exception for fallback handling
        }

        return null;
    }
}