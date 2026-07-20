<?php

namespace App\Services;


use Illuminate\Support\Facades\Http;



class EconomyService
{


    public function getIndicator(
        $country,
        $indicator
    )
    {


        $url =
        "https://api.worldbank.org/v2/country/"
        .$country.
        "/indicator/"
        .$indicator;



        $response =
        Http::get(

            $url,

            [

                'format'=>'json',

                'per_page'=>1

            ]

        );



        return $response->json();


    }





    public function getEconomy($country)
    {


        return [


            'GDP'=>
            $this->getIndicator(
                $country,
                'NY.GDP.MKTP.CD'
            ),



            'inflation'=>
            $this->getIndicator(
                $country,
                'FP.CPI.TOTL.ZG'
            ),



            'population'=>
            $this->getIndicator(
                $country,
                'SP.POP.TOTL'
            ),



            'export'=>
            $this->getIndicator(
                $country,
                'TX.VAL.MRCH.CD.WT'
            ),



            'import'=>
            $this->getIndicator(
                $country,
                'TM.VAL.MRCH.CD.WT'
            )

        ];

    }


}