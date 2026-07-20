<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Services\CountryService;

class CountryController extends Controller
{

    /**
     * Menampilkan semua negara
     */
    public function index(CountryService $service)
    {

        return response()->json(
            $service->getCountries()
        );

    }


    /**
     * Menampilkan detail negara berdasarkan kode
     */
    public function show($code)
    {

        $country = Country::where(
            'code',
            strtoupper($code)
        )->first();


        if (!$country) {

            return response()->json([

                'success'=>false,

                'message'=>'Country not found'

            ],404);

        }


        return response()->json([

            'success'=>true,

            'data'=>$country

        ]);

    }


}