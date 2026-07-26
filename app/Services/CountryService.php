<?php

namespace App\Services;

use App\Models\Country;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class CountryService
{
    public function getCountries()
    {
        try {
            if (!Schema::hasTable('countries') || Country::count() === 0) {
                Artisan::call('migrate', ['--force' => true]);
                Artisan::call('db:seed', ['--force' => true]);
            }
        } catch (\Throwable $e) {}

        return Country::all();
    }

    public function fetchRestCountry($code)
    {
        try {
            $response = \Illuminate\Support\Facades\Http::timeout(3)->get("https://restcountries.com/v3.1/alpha/" . strtoupper($code));
            if ($response->successful()) {
                $data = $response->json();
                return $data[0] ?? null;
            }
        } catch (\Throwable $e) {}

        return null;
    }
}