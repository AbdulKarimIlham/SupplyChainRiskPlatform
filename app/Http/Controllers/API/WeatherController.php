<?php


namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;

use App\Models\Country;

use App\Models\WeatherData;

use App\Services\WeatherService;



class WeatherController extends Controller
{


    public function show(
        $code,
        WeatherService $service
    )
    {


        $country = Country::where(
            'code',
            strtoupper($code)
        )->first();



        if(!$country)
        {

            return response()->json([

                'message'=>'Country not found'

            ],404);

        }



        $weather =
        $service->getWeather(

            $country->latitude,

            $country->longitude

        );



        $current =
        $weather['current_weather'];



        // menentukan risiko cuaca

        $risk =
        $this->calculateRisk(
            $current
        );



        WeatherData::create([


            'country_id'=>
            $country->id,


            'temperature'=>
            $current['temperature'],


            'rain'=>0,


            'wind_speed'=>
            $current['windspeed'],


            'weather_status'=>
            'Monitoring',


            'risk_level'=>
            $risk


        ]);




        return response()->json([


            'success'=>true,


            'country'=>
            $country->name,


            'weather'=>[


                'temperature'=>
                $current['temperature'],


                'wind_speed'=>
                $current['windspeed'],


                'risk'=>
                $risk


            ]


        ]);



    }




    private function calculateRisk($data)
    {


        if(
            $data['windspeed'] > 40
        )
        {

            return "High";

        }


        elseif(
            $data['windspeed'] > 20
        )
        {

            return "Medium";

        }


        else
        {

            return "Low";

        }


    }


}