<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Watchlist;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WatchlistController extends Controller
{
    public function index()
    {
        $userId = Auth::id() ?? 1; // Fallback to 1 for guest/demo mode

        $watchlists = Watchlist::with(['country.riskScores'])
            ->where('user_id', $userId)
            ->get()
            ->map(function ($item) {
                $latestRisk = $item->country->riskScores->first();
                return [
                    'id' => $item->id,
                    'country_id' => $item->country_id,
                    'country_name' => $item->country->name,
                    'country_code' => $item->country->code,
                    'region' => $item->country->region,
                    'currency' => $item->country->currency,
                    'total_score' => $latestRisk ? $latestRisk->total_score : null,
                    'risk_status' => $latestRisk ? $latestRisk->status : 'Not Evaluated',
                    'created_at' => $item->created_at->format('Y-m-d H:i:s'),
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $watchlists
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'country_id' => 'nullable|exists:countries,id',
            'code' => 'nullable|string',
        ]);

        $userId = Auth::id() ?? 1;
        $countryId = $request->country_id;

        if (!$countryId && $request->code) {
            $country = Country::where('code', strtoupper($request->code))->first();
            if ($country) {
                $countryId = $country->id;
            }
        }

        if (!$countryId) {
            return response()->json(['message' => 'Country specified is invalid'], 400);
        }

        $watchlist = Watchlist::firstOrCreate([
            'user_id' => $userId,
            'country_id' => $countryId
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Country added to watchlist',
            'data' => $watchlist
        ]);
    }

    public function destroy($id)
    {
        $userId = Auth::id() ?? 1;

        $watchlist = Watchlist::where('user_id', $userId)
            ->where(function ($q) use ($id) {
                $q->where('id', $id)->orWhere('country_id', $id);
            })
            ->first();

        if (!$watchlist) {
            return response()->json(['message' => 'Watchlist entry not found'], 404);
        }

        $watchlist->delete();

        return response()->json([
            'success' => true,
            'message' => 'Removed from watchlist'
        ]);
    }
}
