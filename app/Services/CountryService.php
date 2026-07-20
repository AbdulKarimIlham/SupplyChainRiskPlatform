<?php

namespace App\Services;

use App\Models\Country;


class CountryService
{


    public function getCountries()
    {

        return Country::all();

    }


}