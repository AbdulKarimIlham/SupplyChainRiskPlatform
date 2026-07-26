<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\EconomicData;
use App\Services\EconomyService;

class EconomyController extends Controller
{
    public function show($code, EconomyService $service)
    {
        $country = Country::where('code', strtoupper($code))->first();

        if (!$country) {
            return response()->json([
                'message' => 'Country not found'
            ], 404);
        }

        // Try live World Bank API first
        $liveData = $service->getEconomy($country->code);

        $dbData = EconomicData::where('country_id', $country->id)->latest()->first();

        $gdp = $liveData['gdp'] ?? $dbData?->gdp;
        $inflation = $liveData['inflation'] ?? $dbData?->inflation;
        $population = $liveData['population'] ?? $dbData?->population;
        $export = $liveData['export'] ?? $dbData?->export_value;
        $import = $liveData['import'] ?? $dbData?->import_value;

        if ($gdp !== null) {
            if ($dbData) {
                $dbData->update([
                    'gdp' => $gdp,
                    'inflation' => $inflation,
                    'population' => $population,
                    'export_value' => $export,
                    'import_value' => $import,
                    'year' => (int) date('Y')
                ]);
            } else {
                $dbData = EconomicData::create([
                    'country_id' => $country->id,
                    'gdp' => $gdp,
                    'inflation' => $inflation,
                    'population' => $population,
                    'export_value' => $export,
                    'import_value' => $import,
                    'year' => (int) date('Y')
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'country' => $country->name,
            'economy' => [
                'gdp' => $gdp ?? 0,
                'inflation' => $inflation ?? 0,
                'population' => $population ?? 0,
                'export' => $export ?? 0,
                'import' => $import ?? 0,
            ]
        ]);
    }
}