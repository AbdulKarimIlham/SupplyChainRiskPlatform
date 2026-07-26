<?php

namespace App\Services;


use Illuminate\Support\Facades\Http;



class CurrencyService
{


    public function getRate($currency)
    {
        try {
            $response = Http::timeout(4)->get("https://open.er-api.com/v6/latest/USD");
            if ($response->successful()) {
                $data = $response->json();
                $rate = $data['rates'][$currency] ?? null;
                if ($rate !== null && $rate > 0) {
                    return [
                        'base' => 'USD',
                        'target' => $currency,
                        'rate' => (float) $rate
                    ];
                }
            }
        } catch (\Throwable $e) {
            // Silence exception for fallback handling
        }

        return null;
    }
}