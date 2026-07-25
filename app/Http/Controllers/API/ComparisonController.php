<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\EconomicData;
use App\Models\CurrencyRate;
use App\Models\WeatherData;
use App\Models\NewsCache;
use App\Models\RiskScore;
use App\Services\RiskScoreService;

class ComparisonController extends Controller
{
    protected $riskService;

    public function __construct(RiskScoreService $riskService)
    {
        $this->riskService = $riskService;
    }

    public function compare($code1, $code2)
    {
        $c1 = Country::where('code', strtoupper($code1))->first();
        $c2 = Country::where('code', strtoupper($code2))->first();

        if (!$c1 || !$c2) {
            return response()->json([
                'message' => 'One or both country codes were not found.'
            ], 404);
        }

        $data1 = $this->getCountryComparisonMetrics($c1);
        $data2 = $this->getCountryComparisonMetrics($c2);

        return response()->json([
            'success' => true,
            'country1' => $data1,
            'country2' => $data2
        ]);
    }

    private function getCountryComparisonMetrics($country)
    {
        $economic = EconomicData::where('country_id', $country->id)->latest()->first();
        $currency = CurrencyRate::where('country_id', $country->id)->latest()->first();
        $weather = WeatherData::where('country_id', $country->id)->latest()->first();
        $news = NewsCache::where('country_id', $country->id)->get();
        $calculatedRisk = $this->riskService->calculate($country);

        $totalNews = $news->count();
        $negCount = $news->filter(fn($n) => strtolower($n->sentiment) === 'negative')->count();
        $posCount = $news->filter(fn($n) => strtolower($n->sentiment) === 'positive')->count();

        $newsSentimentPct = [
            'positive' => $totalNews > 0 ? round(($posCount / $totalNews) * 100) : 0,
            'negative' => $totalNews > 0 ? round(($negCount / $totalNews) * 100) : 0,
            'neutral' => $totalNews > 0 ? round((($totalNews - $posCount - $negCount) / $totalNews) * 100) : 100,
        ];

        return [
            'info' => [
                'id' => $country->id,
                'name' => $country->name,
                'code' => $country->code,
                'region' => $country->region,
                'currency' => $country->currency,
                'language' => $country->language
            ],
            'economic' => [
                'gdp' => $economic?->gdp ?? null,
                'inflation' => $economic?->inflation ?? null,
                'population' => $economic?->population ?? null,
                'export_value' => $economic?->export_value ?? null,
                'import_value' => $economic?->import_value ?? null,
            ],
            'currency' => [
                'base' => 'USD',
                'target' => $country->currency,
                'rate' => $currency?->exchange_rate ?? null,
                'risk_level' => ucfirst($currency?->risk_level ?? 'Low')
            ],
            'weather' => [
                'temperature' => $weather?->temperature ?? null,
                'wind_speed' => $weather?->wind_speed ?? null,
                'risk_level' => ucfirst($weather?->risk_level ?? 'Low')
            ],
            'news_sentiment' => $newsSentimentPct,
            'risk_score' => $calculatedRisk
        ];
    }
}
