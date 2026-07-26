<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\RiskScore;
use App\Models\RiskHistory;
use App\Services\RiskScoreService;

class RiskGeneratorController extends Controller
{
    protected $riskService;

    public function __construct(RiskScoreService $riskService)
    {
        $this->riskService = $riskService;
    }

    public function generate()
    {
        $countries = Country::all();
        $now = now();
        $today = $now->format('Y-m-d');
        $riskRecords = [];
        $historyRecords = [];
        $result = [];

        foreach ($countries as $country) {
            $calculated = $this->riskService->calculate($country);

            $riskRecords[] = [
                'country_id' => $country->id,
                'weather_risk' => $calculated['weather_risk'],
                'inflation_risk' => $calculated['inflation_risk'],
                'currency_risk' => $calculated['currency_risk'],
                'news_risk' => $calculated['news_risk'],
                'total_score' => $calculated['total_score'],
                'status' => $calculated['status'],
                'created_at' => $now,
                'updated_at' => $now,
            ];

            $historyRecords[] = [
                'country_id' => $country->id,
                'date' => $today,
                'total_score' => $calculated['total_score'],
                'status' => $calculated['status'],
                'created_at' => $now,
                'updated_at' => $now,
            ];

            $result[] = [
                "country" => $country->name,
                "score" => $calculated['total_score'],
                "status" => $calculated['status']
            ];
        }

        RiskScore::upsert($riskRecords, ['country_id'], ['weather_risk', 'inflation_risk', 'currency_risk', 'news_risk', 'total_score', 'status', 'updated_at']);
        RiskHistory::upsert($historyRecords, ['country_id', 'date'], ['total_score', 'status', 'updated_at']);

        return response()->json([
            "success" => true,
            "message" => "Risk generated successfully",
            "data" => $result
        ]);
    }
}