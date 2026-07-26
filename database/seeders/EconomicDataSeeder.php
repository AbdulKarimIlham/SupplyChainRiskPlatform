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
        $now = now();
        $records = [];

        foreach ($countries as $country) {
            $inflation = rand(0, 10) + rand(0, 99) / 100;
            $records[] = [
                'country_id' => $country->id,
                'gdp' => rand(150000, 4500000),
                'inflation' => $inflation,
                'population' => rand(5000000, 300000000),
                'export_value' => rand(25000, 850000),
                'import_value' => rand(20000, 750000),
                'year' => 2026,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        EconomicData::insert($records);
    }
}