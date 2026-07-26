<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CurrencyRate;
use App\Models\Country;

class CurrencyRatesSeeder extends Seeder
{
    public function run(): void
    {
        $countries = Country::all();
        $now = now();
        $records = [];
        $today = $now->format('Y-m-d');

        foreach ($countries as $country) {
            $change = rand(-5, 5) + rand(0, 99) / 100;
            $rate = rand(50, 20000) + rand(0, 99) / 100;
            $risk = abs($change) > 5 ? 'high' : (abs($change) > 3 ? 'medium' : 'low');

            $records[] = [
                'country_id' => $country->id,
                'base_currency' => 'USD',
                'target_currency' => $country->currency,
                'exchange_rate' => $rate,
                'change_percentage' => $change,
                'risk_level' => $risk,
                'date' => $today,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        CurrencyRate::insert($records);
    }
}