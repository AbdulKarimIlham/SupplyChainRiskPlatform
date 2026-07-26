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

        $baseline = [
            'IDN' => ['gdp' => 1371171000000, 'inflation' => 2.50, 'population' => 277534122, 'export' => 258820000000, 'import' => 221800000000],
            'CHN' => ['gdp' => 17963170000000, 'inflation' => 0.30, 'population' => 1409670000, 'export' => 3380000000000, 'import' => 2550000000000],
            'JPN' => ['gdp' => 4210600000000, 'inflation' => 2.80, 'population' => 125120000, 'export' => 717000000000, 'import' => 757000000000],
            'KOR' => ['gdp' => 1712790000000, 'inflation' => 2.60, 'population' => 51710000, 'export' => 632000000000, 'import' => 643000000000],
            'IND' => ['gdp' => 3549910000000, 'inflation' => 4.80, 'population' => 1428620000, 'export' => 437000000000, 'import' => 677000000000],
            'SGP' => ['gdp' => 501428000000, 'inflation' => 2.40, 'population' => 5917600, 'export' => 476000000000, 'import' => 423000000000],
            'MYS' => ['gdp' => 399649000000, 'inflation' => 1.80, 'population' => 34300000, 'export' => 312000000000, 'import' => 265000000000],
            'THA' => ['gdp' => 514945000000, 'inflation' => 1.20, 'population' => 71800000, 'export' => 284000000000, 'import' => 289000000000],
            'USA' => ['gdp' => 27360000000000, 'inflation' => 2.90, 'population' => 335890000, 'export' => 2019000000000, 'import' => 3172000000000],
            'DEU' => ['gdp' => 4456000000000, 'inflation' => 2.40, 'population' => 84360000, 'export' => 1688000000000, 'import' => 1471000000000],
            'GBR' => ['gdp' => 3340000000000, 'inflation' => 2.20, 'population' => 67700000, 'export' => 520000000000, 'import' => 790000000000],
            'AUS' => ['gdp' => 1723000000000, 'inflation' => 3.60, 'population' => 26600000, 'export' => 370000000000, 'import' => 290000000000],
            'FRA' => ['gdp' => 3030000000000, 'inflation' => 2.30, 'population' => 68100000, 'export' => 640000000000, 'import' => 780000000000],
        ];

        foreach ($countries as $country) {
            $code = strtoupper($country->code);
            $data = $baseline[$code] ?? [
                'gdp' => 250000000000,
                'inflation' => 2.50,
                'population' => 25000000,
                'export' => 50000000000,
                'import' => 45000000000,
            ];

            $records[] = [
                'country_id' => $country->id,
                'gdp' => $data['gdp'],
                'inflation' => $data['inflation'],
                'population' => $data['population'],
                'export_value' => $data['export'],
                'import_value' => $data['import'],
                'year' => (int) date('Y'),
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        EconomicData::insert($records);
    }
}