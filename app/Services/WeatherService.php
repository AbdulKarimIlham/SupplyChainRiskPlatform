<?php

namespace App\Services;


use Illuminate\Support\Facades\Http;



class WeatherService
{


    public function getWeather(
        $latitude,
        $longitude
    )
    {


        $response = Http::timeout(3)->get(

            'https://api.open-meteo.com/v1/forecast',

            [

                'latitude'=>$latitude,

                'longitude'=>$longitude,


                'current_weather'=>true,


                'hourly'=>
                'rain'

            ]

        );


        return $response->json();


    }


}