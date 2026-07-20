<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NewsCache;
use App\Models\Country;

class NewsCacheSeeder extends Seeder
{
    public function run(): void
    {
        $countries = Country::all();
        $sentiments = ['Neutral','Positive','Negative'];

        foreach ($countries as $country) {
            for ($i=0;$i<5;$i++){ // 5 berita per negara
                $sentiment = $sentiments[rand(0,2)];
                $score = $sentiment=='Positive' ? rand(1,5) : ($sentiment=='Negative' ? -rand(1,5) : 0);

                NewsCache::create([
                    'country_id' => $country->id,
                    'title' => 'News '.$i.' for '.$country->name,
                    'description' => 'Simulated news content for '.$country->name,
                    'source' => 'Simulated News Agency',
                    'sentiment' => $sentiment,
                    'sentiment_score' => $score
                ]);
            }
        }
    }
}