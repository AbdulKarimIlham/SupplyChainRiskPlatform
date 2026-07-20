<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Port;
use Illuminate\Http\Request;

class PortController extends Controller
{
    public function index(Request $request)
    {
        $query = Port::query();

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('country', 'like', "%{$search}%");
            });
        }

        if ($request->has('country') && !empty($request->country)) {
            $query->where('country', 'like', "%{$request->country}%");
        }

        $ports = $query->get();

        return response()->json([
            'success' => true,
            'count' => $ports->count(),
            'data' => $ports
        ]);
    }

    public function show($id)
    {
        $port = Port::find($id);

        if (!$port) {
            return response()->json(['message' => 'Port not found'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $port
        ]);
    }
}
