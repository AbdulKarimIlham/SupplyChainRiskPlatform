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
        $result = [];

        foreach ($countries as $country) {
            $calculated = $this->riskService->calculate($country);

            RiskScore::updateOrCreate(
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

            $result[] = [
                "country" => $country->name,
                "score" => $calculated['total_score'],
                "status" => $calculated['status']
            ];
        }

        return response()->json([
            "success" => true,
            "message" => "Risk generated successfully",
            "data" => $result
        ]);
    }
}