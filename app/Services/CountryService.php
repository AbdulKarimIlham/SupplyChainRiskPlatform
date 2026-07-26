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
}