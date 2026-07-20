<?php

namespace App\Services;

use App\Models\WeatherData;
use App\Models\EconomicData;
use App\Models\CurrencyRate;
use App\Models\NewsCache;

class RiskScoreService
{
    public function calculate($country)
    {
        $weatherRisk = $this->weatherRisk($country);
        $economicRisk = $this->economicRisk($country);
        $currencyRisk = $this->currencyRisk($country);
        $newsRisk = $this->newsRisk($country);

        // Weighted Risk Model per specification:
        // Weather Risk: 30%, Inflation Risk: 20%, Political/News Risk: 40%, Currency Risk: 10%
        // Component scores are normalized to 0-100 scale then weighted
        $total = round(
            ($weatherRisk * 0.30) +
            ($economicRisk * 0.20) +
            ($newsRisk * 0.40) +
            ($currencyRisk * 0.10)
        );

        $status = $this->level($total);

        return [
            'weather_risk' => $weatherRisk,
            'inflation_risk' => $economicRisk,
            'currency_risk' => $currencyRisk,
            'news_risk' => $newsRisk,
            'total_score' => $total,
            'status' => $status
        ];
    }

    private function weatherRisk($country)
    {
        $data = WeatherData::where('country_id', $country->id)->latest()->first();

        if (!$data) return 20;

        $riskLevel = strtolower($data->risk_level ?? $data->risk ?? 'low');

        if ($riskLevel === 'high') return 85;
        if ($riskLevel === 'medium') return 50;
        return 20;
    }

    private function economicRisk($country)
    {
        $data = EconomicData::where('country_id', $country->id)->latest()->first();

        if (!$data) return 20;

        $inflation = $data->inflation ?? 0;

        if ($inflation > 8) return 90;
        if ($inflation > 5) return 65;
        if ($inflation > 3) return 40;
        return 15;
    }

    private function currencyRisk($country)
    {
        $data = CurrencyRate::where('country_id', $country->id)->latest()->first();

        if (!$data) return 20;

        $riskLevel = strtolower($data->risk_level ?? 'low');

        if ($riskLevel === 'high') return 80;
        if ($riskLevel === 'medium') return 50;
        return 20;
    }

    private function newsRisk($country)
    {
        $data = NewsCache::where('country_id', $country->id)->latest()->get();

        if ($data->count() === 0) return 25;

        $negative = $data->filter(function($item) {
            return strtolower($item->sentiment) === 'negative';
        })->count();

        $percentage = ($negative / $data->count()) * 100;

        if ($percentage > 60) return 90;
        if ($percentage > 35) return 60;
        if ($percentage > 15) return 35;
        return 15;
    }

    public function level($score)
    {
        if ($score >= 65) return "High Risk";
        if ($score >= 40) return "Medium Risk";
        return "Low Risk";
    }
}