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

        $targetCurr = strtoupper($country->currency ?: 'USD');
        $liveData = $service->getRate($targetCurr);

        $dbData = CurrencyRate::where('country_id', $country->id)->latest()->first();

        $rate = $liveData['rate'] ?? $dbData?->exchange_rate;

        if ($rate === null || $rate <= 0) {
            $defaultRates = [
                'IDR' => 16200.0, 'EUR' => 0.92, 'CNY' => 7.25, 'JPY' => 155.0,
                'KRW' => 1380.0, 'INR' => 83.5, 'SGD' => 1.35, 'MYR' => 4.70,
                'THB' => 36.50, 'GBP' => 0.78, 'AUD' => 1.50, 'USD' => 1.0
            ];
            $rate = $defaultRates[$targetCurr] ?? 1.0;
        }

        $risk = $this->calculateRisk(0.15, $targetCurr, $rate);

        if ($dbData) {
            $dbData->update([
                'base_currency' => 'USD',
                'target_currency' => $targetCurr,
                'exchange_rate' => $rate,
                'risk_level' => $risk,
                'date' => date('Y-m-d')
            ]);
        } else {
            $dbData = CurrencyRate::create([
                'country_id' => $country->id,
                'base_currency' => 'USD',
                'target_currency' => $targetCurr,
                'exchange_rate' => $rate,
                'change_percentage' => 0.15,
                'risk_level' => $risk,
                'date' => date('Y-m-d')
            ]);
        }

        return response()->json([
            'success' => true,
            'country' => $country->name,
            'currency' => [
                'base' => 'USD',
                'target' => $targetCurr,
                'rate' => $rate,
                'change_percentage' => $dbData->change_percentage ?? 0,
                'formatted' => $targetCurr . ' ' . number_format($rate, 2, '.', ','),
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

        if (in_array($currency, ['IDR', 'INR', 'BRL', 'RUB', 'TRY', 'ARS'])) {
            return "Medium";
        }

        return "Low";
    }
}