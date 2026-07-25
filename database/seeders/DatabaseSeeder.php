<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
   public function run(): void
{

    User::updateOrCreate(

        [
            'email'=>'admin@gmail.com'
        ],

        [
            'name'=>'Administrator',

            'password'=>Hash::make('admin123'),

            'role'=>'admin'
        ]

    );
        // Menjalankan seeder lainnya
        $this->call([
            CountrySeeder::class,
            WeatherDataSeeder::class,
            EconomicDataSeeder::class,
            CurrencyRatesSeeder::class,
            NewsCacheSeeder::class,
            SentimentSeeder::class,
            PortSeeder::class,
        ]);

        // Auto-generate initial risk scores for all countries
        try {
            app(\App\Http\Controllers\API\RiskGeneratorController::class)->generate();
        } catch (\Throwable $e) {
            // Log or ignore if background generate fails
        }
    }
}