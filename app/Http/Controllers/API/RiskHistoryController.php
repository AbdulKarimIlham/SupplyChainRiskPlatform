<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\RiskHistory;
use Illuminate\Http\Request;

class RiskHistoryController extends Controller
{
    public function show($code)
    {
        // Cari negara berdasarkan kode
        $country = Country::where('code', strtoupper($code))->first();

        // Jika negara tidak ditemukan
        if (!$country) {
            return response()->json([
                'success' => false,
                'message' => 'Country not found'
            ], 404);
        }

        // Ambil riwayat risiko negara
        $data = RiskHistory::where('country_id', $country->id)
            ->orderBy('date', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'country' => $country->name,
            'history' => $data,
        ]);
    }
}