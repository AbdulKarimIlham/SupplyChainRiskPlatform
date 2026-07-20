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

        $data = $service->getRate($country->currency);
        $rate = round($data['rate'], 4);

        // Calculate change percentage if previous rate exists
        $prevRate = CurrencyRate::where('country_id', $country->id)->latest()->first();
        $changePercentage = 0;
        if ($prevRate && $prevRate->exchange_rate > 0) {
            $changePercentage = round((($rate - $prevRate->exchange_rate) / $prevRate->exchange_rate) * 100, 2);
        }

        $risk = $this->calculateRisk($changePercentage, $country->currency, $rate);

        CurrencyRate::create([
            'country_id' => $country->id,
            'base_currency' => 'USD',
            'target_currency' => $country->currency,
            'exchange_rate' => $rate,
            'change_percentage' => $changePercentage,
            'risk_level' => $risk,
            'date' => date('Y-m-d')
        ]);

        return response()->json([
            'success' => true,
            'country' => $country->name,
            'currency' => [
                'base' => 'USD',
                'target' => $country->currency,
                'rate' => $rate,
                'change_percentage' => $changePercentage,
                'formatted' => $country->currency . ' ' . number_format($rate, 2, '.', ','),
                'risk' => $risk
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

        // Fallback baseline for high-volatility currencies
        if (in_array($currency, ['IDR', 'INR', 'BRL', 'RUB', 'TRY', 'ARS'])) {
            return "Medium";
        }

        return "Low";
    }
}