<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Port;

class PortSeeder extends Seeder
{
    public function run(): void
    {
        $ports = [
            ['name' => 'Port of Shanghai', 'country' => 'China', 'latitude' => 31.2304, 'longitude' => 121.4737],
            ['name' => 'Port of Singapore', 'country' => 'Singapore', 'latitude' => 1.2644, 'longitude' => 103.8400],
            ['name' => 'Port of Rotterdam', 'country' => 'Netherlands', 'latitude' => 51.9500, 'longitude' => 4.1400],
            ['name' => 'Port of Hamburg', 'country' => 'Germany', 'latitude' => 53.5459, 'longitude' => 9.9665],
            ['name' => 'Port of Los Angeles', 'country' => 'United States', 'latitude' => 33.7405, 'longitude' => -118.2720],
            ['name' => 'Port of Tanjung Priok', 'country' => 'Indonesia', 'latitude' => -6.1000, 'longitude' => 106.8800],
            ['name' => 'Port of Botany (Sydney)', 'country' => 'Australia', 'latitude' => -33.9680, 'longitude' => 151.2220],
            ['name' => 'Port of Jebel Ali (Dubai)', 'country' => 'United Arab Emirates', 'latitude' => 24.9857, 'longitude' => 55.0642],
            ['name' => 'Port of Santos', 'country' => 'Brazil', 'latitude' => -23.9608, 'longitude' => -46.3339],
            ['name' => 'Port of Yokohama', 'country' => 'Japan', 'latitude' => 35.4437, 'longitude' => 139.6380],
            ['name' => 'Port of Busan', 'country' => 'South Korea', 'latitude' => 35.1028, 'longitude' => 129.0403],
            ['name' => 'Port of Antwerp', 'country' => 'Belgium', 'latitude' => 51.2600, 'longitude' => 4.3300],
            ['name' => 'Port of Felixstowe', 'country' => 'United Kingdom', 'latitude' => 51.9567, 'longitude' => 1.3283],
            ['name' => 'Port of Bremerhaven', 'country' => 'Germany', 'latitude' => 53.5488, 'longitude' => 8.5772],
            ['name' => 'Port of Tanjung Perak (Surabaya)', 'country' => 'Indonesia', 'latitude' => -7.1994, 'longitude' => 112.7308],
            ['name' => 'Port of Ningbo-Zhoushan', 'country' => 'China', 'latitude' => 29.8683, 'longitude' => 121.5440],
        ];

        foreach ($ports as $port) {
            Port::updateOrCreate(
                ['name' => $port['name']],
                $port
            );
        }
    }
}
