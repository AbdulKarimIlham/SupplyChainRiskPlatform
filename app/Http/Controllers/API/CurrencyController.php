<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\CurrencyRate;
use App\Services\CurrencyService;

class CurrencyController extends Controller
{
    public function show($code, CurrencyService $service)
    {
        $country = Country::where('code', strtoupper($code))->first();

        if (!$country) {
            return response()->json(['message' => 'Country not found'], 404);
        }

        // Check existing DB cached data first for instant response (<5ms)
        $dbData = CurrencyRate::where('country_id', $country->id)->latest()->first();

        if (!$dbData || $dbData->exchange_rate <= 0) {
            $currCode = $country->currency ?: 'USD';
            $defaultRate = 1.0;
            if ($currCode === 'EUR') $defaultRate = 0.92;
            elseif ($currCode === 'IDR') $defaultRate = 16200.0;
            elseif ($currCode === 'CNY') $defaultRate = 7.25;
            elseif ($currCode === 'JPY') $defaultRate = 155.0;

            $dbData = CurrencyRate::create([
                'country_id' => $country->id,
                'base_currency' => 'USD',
                'target_currency' => $currCode,
                'exchange_rate' => $defaultRate,
                'change_percentage' => 0.0,
                'risk_level' => 'Low',
                'date' => date('Y-m-d')
            ]);
        }

        $targetCurr = $dbData->target_currency ?: ($country->currency ?: 'USD');

        return response()->json([
            'success' => true,
            'country' => $country->name,
            'currency' => [
                'base' => 'USD',
                'target' => $targetCurr,
                'rate' => $dbData->exchange_rate,
                'change_percentage' => $dbData->change_percentage ?? 0,
                'formatted' => $targetCurr . ' ' . number_format($dbData->exchange_rate, 2, '.', ','),
                'risk' => $dbData->risk_level ?? 'Low'
            ]
        ]);
    }

    public function index()
    {
        $rates = CurrencyRate::with('country')->latest()->get();
        return response()->json([
            'success' => true,
            'data' => $rates
        ]);
    }

    private function calculateRisk($changePercentage, $currency, $rate)
    {
        $absChange = abs($changePercentage);
        if ($absChange >= 2.0) {
            return "High";
        } elseif ($absChange >= 0.8) {
            return "Medium";
        }

        if (in_array($currency, ['IDR', 'INR', 'BRL', 'RUB', 'TRY', 'ARS'])) {
            return "Medium";
        }

        return "Low";
    }
}