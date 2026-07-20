<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;

use App\Models\Country;

use App\Models\EconomicData;

use App\Services\EconomyService;



class EconomyController extends Controller
{


public function show(
    $code,
    EconomyService $service
)
{


    $country =
    Country::where(
        'code',
        strtoupper($code)
    )->first();



    if(!$country)
    {

        return response()->json([

            'message'=>'Country not found'

        ],404);

    }



    $data =
    $service->getEconomy(
        $country->code
    );



    $year =
    date('Y');



    $economy = [

        'gdp'=>
        $this->extract(
            $data['GDP']
        ),


        'inflation'=>
        $this->extract(
            $data['inflation']
        ),


        'population'=>
        $this->extract(
            $data['population']
        ),


        'export'=>
        $this->extract(
            $data['export']
        ),


        'import'=>
        $this->extract(
            $data['import']
        )

    ];



    EconomicData::create([

        'country_id'=>$country->id,

        'gdp'=>$economy['gdp'],

        'inflation'=>$economy['inflation'],

        'population'=>$economy['population'],

        'export_value'=>$economy['export'],

        'import_value'=>$economy['import'],

        'year'=>$year

    ]);



    return response()->json([


        'success'=>true,


        'country'=>$country->name,


        'economy'=>$economy


    ]);

}




private function extract($data)
{


    if(
        isset($data[1][0]['value'])
    )
    {

        return $data[1][0]['value'];

    }


    return null;


}


}