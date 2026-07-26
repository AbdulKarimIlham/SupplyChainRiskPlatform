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

        $ratesMap = [
            'IDR' => 16200.0,
            'EUR' => 0.92,
            'CNY' => 7.25,
            'JPY' => 155.0,
            'KRW' => 1380.0,
            'INR' => 83.5,
            'SGD' => 1.35,
            'MYR' => 4.70,
            'THB' => 36.50,
            'GBP' => 0.78,
            'AUD' => 1.50,
            'CAD' => 1.37,
            'CHF' => 0.89,
            'HKD' => 7.82,
            'NZD' => 1.63,
            'USD' => 1.00,
        ];

        foreach ($countries as $country) {
            $curr = strtoupper($country->currency ?: 'USD');
            $rate = $ratesMap[$curr] ?? 1.0;
            $change = 0.15;
            $risk = 'Low';

            $records[] = [
                'country_id' => $country->id,
                'base_currency' => 'USD',
                'target_currency' => $curr,
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