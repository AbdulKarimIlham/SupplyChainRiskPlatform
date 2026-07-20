<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EconomicData;
use App\Models\Country;

class EconomicDataSeeder extends Seeder
{
    public function run(): void
    {
        $countries = Country::all();

        foreach ($countries as $country) {
            $inflation = rand(0,10) + rand(0,99)/100; // 0.00 - 10.99%
            EconomicData::create([
                'country_id' => $country->id,
                'gdp' => rand(10000,300000), // in million USD
                'inflation' => $inflation,
                'population' => rand(500000,1400000000),
                'export_value' => rand(5000,100000),
                'import_value' => rand(5000,100000),
                'year' => 2026
            ]);
        }
    }
}