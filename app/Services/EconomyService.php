<?php

namespace App\Services;


use Illuminate\Support\Facades\Http;



class EconomyService
{


    public function getIndicator($country, $indicator)
    {
        try {
            $url = "https://api.worldbank.org/v2/country/" . strtoupper($country) . "/indicator/" . $indicator;
            $response = Http::timeout(4)->get($url, [
                'format' => 'json',
                'per_page' => 5
            ]);

            if ($response->successful()) {
                $data = $response->json();
                if (isset($data[1]) && is_array($data[1])) {
                    foreach ($data[1] as $entry) {
                        if (isset($entry['value']) && $entry['value'] !== null) {
                            return (float) $entry['value'];
                        }
                    }
                }
            }
        } catch (\Throwable $e) {
            // Silence exception for fallback handling
        }

        return null;
    }

    public function getEconomy($country)
    {
        return [
            'gdp' => $this->getIndicator($country, 'NY.GDP.MKTP.CD'),
            'inflation' => $this->getIndicator($country, 'FP.CPI.TOTL.ZG'),
            'population' => $this->getIndicator($country, 'SP.POP.TOTL'),
            'export' => $this->getIndicator($country, 'TX.VAL.MRCH.CD.WT'),
            'import' => $this->getIndicator($country, 'TM.VAL.MRCH.CD.WT'),
        ];
    }
}