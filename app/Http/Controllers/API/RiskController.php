<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\RiskScore;
use App\Models\RiskHistory;
use App\Services\RiskScoreService;

class RiskController extends Controller
{
    protected $riskService;

    public function __construct(RiskScoreService $riskService)
    {
        $this->riskService = $riskService;
    }

    public function index()
    {
        $scores = RiskScore::with('country')->get();
        return response()->json([
            'success' => true,
            'data' => $scores
        ]);
    }

    public function show($code)
    {
        $country = Country::where('code', strtoupper($code))->first();

        if (!$country) {
            return response()->json([
                'message' => 'Country not found'
            ], 404);
        }

        $calculated = $this->riskService->calculate($country);

        // Update or Create Risk Score
        $riskScore = RiskScore::updateOrCreate(
            ['country_id' => $country->id],
            [
                'weather_risk' => $calculated['weather_risk'],
                'inflation_risk' => $calculated['inflation_risk'],
                'currency_risk' => $calculated['currency_risk'],
                'news_risk' => $calculated['news_risk'],
                'total_score' => $calculated['total_score'],
                'status' => $calculated['status']
            ]
        );

        // Historical tracking
        RiskHistory::updateOrCreate(
            [
                'country_id' => $country->id,
                'date' => now()->format('Y-m-d')
            ],
            [
                'total_score' => $calculated['total_score'],
                'status' => $calculated['status']
            ]
        );

        return response()->json([
            'success' => true,
            'country' => $country->name,
            'country_code' => $country->code,
            'risk' => [
                'weather_risk' => $calculated['weather_risk'],
                'inflation_risk' => $calculated['inflation_risk'],
                'currency_risk' => $calculated['currency_risk'],
                'news_risk' => $calculated['news_risk'],
                'total_score' => $calculated['total_score'],
                'status' => $calculated['status']
            ]
        ]);
    }

    public function ranking()
    {
        try {
            if (!\Illuminate\Support\Facades\Schema::hasTable('risk_scores') || RiskScore::count() === 0) {
                \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
                \Illuminate\Support\Facades\Artisan::call('db:seed', ['--force' => true]);
            }
        } catch (\Throwable $e) {}

        $ranking = RiskScore::with('country')
            ->orderByDesc('total_score')
            ->get()
            ->map(function ($item) {
                return [
                    'country_id' => $item->country_id,
                    'country' => $item->country ? $item->country->name : 'Unknown',
                    'code' => $item->country ? $item->country->code : '',
                    'score' => $item->total_score,
                    'status' => $item->status,
                    'weather_risk' => $item->weather_risk,
                    'inflation_risk' => $item->inflation_risk,
                    'currency_risk' => $item->currency_risk,
                    'news_risk' => $item->news_risk,
                ];
            });

        return response()->json([
            'success' => true,
            'ranking' => $ranking
        ]);
    }

    public function history($code)
    {
        $country = Country::where('code', strtoupper($code))->first();

        if (!$country) {
            return response()->json(['message' => 'Country not found'], 404);
        }

        $history = RiskHistory::where('country_id', $country->id)
            ->orderBy('date', 'asc')
            ->get(['date', 'total_score', 'status']);

        return response()->json([
            'success' => true,
            'country' => $country->name,
            'history' => $history
        ]);
    }
}