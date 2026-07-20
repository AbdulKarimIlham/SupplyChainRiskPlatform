<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;


class CountrySeeder extends Seeder
{

    public function run(): void
    {


        $countries = [

            /*
            |--------------------------------------------------------------------------
            | ASIA
            |--------------------------------------------------------------------------
            */


            [
                'name'=>'Indonesia',
                'code'=>'IDN',
                'region'=>'Asia',
                'currency'=>'IDR',
                'language'=>'Indonesian',
                'latitude'=>-6.2088,
                'longitude'=>106.8456
            ],

            [
                'name'=>'China',
                'code'=>'CHN',
                'region'=>'Asia',
                'currency'=>'CNY',
                'language'=>'Chinese',
                'latitude'=>39.9042,
                'longitude'=>116.4074
            ],

            [
                'name'=>'Japan',
                'code'=>'JPN',
                'region'=>'Asia',
                'currency'=>'JPY',
                'language'=>'Japanese',
                'latitude'=>35.6762,
                'longitude'=>139.6503
            ],

            [
                'name'=>'South Korea',
                'code'=>'KOR',
                'region'=>'Asia',
                'currency'=>'KRW',
                'language'=>'Korean',
                'latitude'=>37.5665,
                'longitude'=>126.9780
            ],

            [
                'name'=>'India',
                'code'=>'IND',
                'region'=>'Asia',
                'currency'=>'INR',
                'language'=>'Hindi',
                'latitude'=>28.6139,
                'longitude'=>77.2090
            ],


            [
                'name'=>'Singapore',
                'code'=>'SGP',
                'region'=>'Asia',
                'currency'=>'SGD',
                'language'=>'English',
                'latitude'=>1.3521,
                'longitude'=>103.8198
            ],


            [
                'name'=>'Malaysia',
                'code'=>'MYS',
                'region'=>'Asia',
                'currency'=>'MYR',
                'language'=>'Malay',
                'latitude'=>3.1390,
                'longitude'=>101.6869
            ],


            [
                'name'=>'Thailand',
                'code'=>'THA',
                'region'=>'Asia',
                'currency'=>'THB',
                'language'=>'Thai',
                'latitude'=>13.7563,
                'longitude'=>100.5018
            ],


            [
                'name'=>'Vietnam',
                'code'=>'VNM',
                'region'=>'Asia',
                'currency'=>'VND',
                'language'=>'Vietnamese',
                'latitude'=>21.0285,
                'longitude'=>105.8542
            ],


            [
                'name'=>'Philippines',
                'code'=>'PHL',
                'region'=>'Asia',
                'currency'=>'PHP',
                'language'=>'Filipino',
                'latitude'=>14.5995,
                'longitude'=>120.9842
            ],


            [
                'name'=>'Pakistan',
                'code'=>'PAK',
                'region'=>'Asia',
                'currency'=>'PKR',
                'language'=>'Urdu',
                'latitude'=>33.6844,
                'longitude'=>73.0479
            ],


            [
                'name'=>'Bangladesh',
                'code'=>'BGD',
                'region'=>'Asia',
                'currency'=>'BDT',
                'language'=>'Bengali',
                'latitude'=>23.8103,
                'longitude'=>90.4125
            ],


            [
                'name'=>'Sri Lanka',
                'code'=>'LKA',
                'region'=>'Asia',
                'currency'=>'LKR',
                'language'=>'Sinhala',
                'latitude'=>6.9271,
                'longitude'=>79.8612
            ],


            [
                'name'=>'Myanmar',
                'code'=>'MMR',
                'region'=>'Asia',
                'currency'=>'MMK',
                'language'=>'Burmese',
                'latitude'=>19.7633,
                'longitude'=>96.0785
            ],


            [
                'name'=>'Cambodia',
                'code'=>'KHM',
                'region'=>'Asia',
                'currency'=>'KHR',
                'language'=>'Khmer',
                'latitude'=>11.5564,
                'longitude'=>104.9282
            ],


            [
                'name'=>'Laos',
                'code'=>'LAO',
                'region'=>'Asia',
                'currency'=>'LAK',
                'language'=>'Lao',
                'latitude'=>17.9757,
                'longitude'=>102.6331
            ],


            [
                'name'=>'Nepal',
                'code'=>'NPL',
                'region'=>'Asia',
                'currency'=>'NPR',
                'language'=>'Nepali',
                'latitude'=>27.7172,
                'longitude'=>85.3240
            ],


            [
                'name'=>'Mongolia',
                'code'=>'MNG',
                'region'=>'Asia',
                'currency'=>'MNT',
                'language'=>'Mongolian',
                'latitude'=>47.8864,
                'longitude'=>106.9057
            ],


            [
                'name'=>'Brunei',
                'code'=>'BRN',
                'region'=>'Asia',
                'currency'=>'BND',
                'language'=>'Malay',
                'latitude'=>4.9031,
                'longitude'=>114.9398
            ],


            [
                'name'=>'Taiwan',
                'code'=>'TWN',
                'region'=>'Asia',
                'currency'=>'TWD',
                'language'=>'Chinese',
                'latitude'=>25.0330,
                'longitude'=>121.5654
            ],

            [
                'name'=>'Afghanistan',
                'code'=>'AFG',
                'region'=>'Asia',
                'currency'=>'AFN',
                'language'=>'Pashto',
                'latitude'=>34.5553,
                'longitude'=>69.2075
            ],

            [
                'name'=>'Iran',
                'code'=>'IRN',
                'region'=>'Asia',
                'currency'=>'IRR',
                'language'=>'Persian',
                'latitude'=>35.6892,
                'longitude'=>51.3890
            ],

            [
                'name'=>'Iraq',
                'code'=>'IRQ',
                'region'=>'Asia',
                'currency'=>'IQD',
                'language'=>'Arabic',
                'latitude'=>33.3152,
                'longitude'=>44.3661
            ],

            [
                'name'=>'Jordan',
                'code'=>'JOR',
                'region'=>'Asia',
                'currency'=>'JOD',
                'language'=>'Arabic',
                'latitude'=>31.9454,
                'longitude'=>35.9284
            ],

            [
                'name'=>'Kuwait',
                'code'=>'KWT',
                'region'=>'Asia',
                'currency'=>'KWD',
                'language'=>'Arabic',
                'latitude'=>29.3759,
                'longitude'=>47.9774
            ],

            [
                'name'=>'Oman',
                'code'=>'OMN',
                'region'=>'Asia',
                'currency'=>'OMR',
                'language'=>'Arabic',
                'latitude'=>23.5880,
                'longitude'=>58.3829
            ],

            [
                'name'=>'Bahrain',
                'code'=>'BHR',
                'region'=>'Asia',
                'currency'=>'BHD',
                'language'=>'Arabic',
                'latitude'=>26.2235,
                'longitude'=>50.5876
            ],

            [
                'name'=>'Lebanon',
                'code'=>'LBN',
                'region'=>'Asia',
                'currency'=>'LBP',
                'language'=>'Arabic',
                'latitude'=>33.8938,
                'longitude'=>35.5018
            ],



            /*
            |--------------------------------------------------------------------------
            | MIDDLE EAST
            |--------------------------------------------------------------------------
            */


            [
                'name'=>'Saudi Arabia',
                'code'=>'SAU',
                'region'=>'Asia',
                'currency'=>'SAR',
                'language'=>'Arabic',
                'latitude'=>24.7136,
                'longitude'=>46.6753
            ],


            [
                'name'=>'United Arab Emirates',
                'code'=>'ARE',
                'region'=>'Asia',
                'currency'=>'AED',
                'language'=>'Arabic',
                'latitude'=>25.2048,
                'longitude'=>55.2708
            ],


            [
                'name'=>'Qatar',
                'code'=>'QAT',
                'region'=>'Asia',
                'currency'=>'QAR',
                'language'=>'Arabic',
                'latitude'=>25.2854,
                'longitude'=>51.5310
            ],


            [
                'name'=>'Israel',
                'code'=>'ISR',
                'region'=>'Asia',
                'currency'=>'ILS',
                'language'=>'Hebrew',
                'latitude'=>31.7683,
                'longitude'=>35.2137
            ],

                        /*
            |--------------------------------------------------------------------------
            | EUROPE
            |--------------------------------------------------------------------------
            */


            [
                'name'=>'Germany',
                'code'=>'DEU',
                'region'=>'Europe',
                'currency'=>'EUR',
                'language'=>'German',
                'latitude'=>52.5200,
                'longitude'=>13.4050
            ],

            [
                'name'=>'France',
                'code'=>'FRA',
                'region'=>'Europe',
                'currency'=>'EUR',
                'language'=>'French',
                'latitude'=>48.8566,
                'longitude'=>2.3522
            ],

            [
                'name'=>'United Kingdom',
                'code'=>'GBR',
                'region'=>'Europe',
                'currency'=>'GBP',
                'language'=>'English',
                'latitude'=>51.5074,
                'longitude'=>-0.1278
            ],

            [
                'name'=>'Italy',
                'code'=>'ITA',
                'region'=>'Europe',
                'currency'=>'EUR',
                'language'=>'Italian',
                'latitude'=>41.9028,
                'longitude'=>12.4964
            ],

            [
                'name'=>'Spain',
                'code'=>'ESP',
                'region'=>'Europe',
                'currency'=>'EUR',
                'language'=>'Spanish',
                'latitude'=>40.4168,
                'longitude'=>-3.7038
            ],

            [
                'name'=>'Portugal',
                'code'=>'PRT',
                'region'=>'Europe',
                'currency'=>'EUR',
                'language'=>'Portuguese',
                'latitude'=>38.7223,
                'longitude'=>-9.1393
            ],

            [
                'name'=>'Netherlands',
                'code'=>'NLD',
                'region'=>'Europe',
                'currency'=>'EUR',
                'language'=>'Dutch',
                'latitude'=>52.3676,
                'longitude'=>4.9041
            ],

            [
                'name'=>'Belgium',
                'code'=>'BEL',
                'region'=>'Europe',
                'currency'=>'EUR',
                'language'=>'Dutch/French',
                'latitude'=>50.8503,
                'longitude'=>4.3517
            ],

            [
                'name'=>'Switzerland',
                'code'=>'CHE',
                'region'=>'Europe',
                'currency'=>'CHF',
                'language'=>'German/French',
                'latitude'=>46.9480,
                'longitude'=>7.4474
            ],

            [
                'name'=>'Austria',
                'code'=>'AUT',
                'region'=>'Europe',
                'currency'=>'EUR',
                'language'=>'German',
                'latitude'=>48.2082,
                'longitude'=>16.3738
            ],

            [
                'name'=>'Poland',
                'code'=>'POL',
                'region'=>'Europe',
                'currency'=>'PLN',
                'language'=>'Polish',
                'latitude'=>52.2297,
                'longitude'=>21.0122
            ],

            [
                'name'=>'Czech Republic',
                'code'=>'CZE',
                'region'=>'Europe',
                'currency'=>'CZK',
                'language'=>'Czech',
                'latitude'=>50.0755,
                'longitude'=>14.4378
            ],

            [
                'name'=>'Slovakia',
                'code'=>'SVK',
                'region'=>'Europe',
                'currency'=>'EUR',
                'language'=>'Slovak',
                'latitude'=>48.1486,
                'longitude'=>17.1077
            ],

            [
                'name'=>'Hungary',
                'code'=>'HUN',
                'region'=>'Europe',
                'currency'=>'HUF',
                'language'=>'Hungarian',
                'latitude'=>47.4979,
                'longitude'=>19.0402
            ],

            [
                'name'=>'Romania',
                'code'=>'ROU',
                'region'=>'Europe',
                'currency'=>'RON',
                'language'=>'Romanian',
                'latitude'=>44.4268,
                'longitude'=>26.1025
            ],

            [
                'name'=>'Bulgaria',
                'code'=>'BGR',
                'region'=>'Europe',
                'currency'=>'BGN',
                'language'=>'Bulgarian',
                'latitude'=>42.6977,
                'longitude'=>23.3219
            ],

            [
                'name'=>'Greece',
                'code'=>'GRC',
                'region'=>'Europe',
                'currency'=>'EUR',
                'language'=>'Greek',
                'latitude'=>37.9838,
                'longitude'=>23.7275
            ],

            [
                'name'=>'Sweden',
                'code'=>'SWE',
                'region'=>'Europe',
                'currency'=>'SEK',
                'language'=>'Swedish',
                'latitude'=>59.3293,
                'longitude'=>18.0686
            ],

            [
                'name'=>'Norway',
                'code'=>'NOR',
                'region'=>'Europe',
                'currency'=>'NOK',
                'language'=>'Norwegian',
                'latitude'=>59.9139,
                'longitude'=>10.7522
            ],

            [
                'name'=>'Denmark',
                'code'=>'DNK',
                'region'=>'Europe',
                'currency'=>'DKK',
                'language'=>'Danish',
                'latitude'=>55.6761,
                'longitude'=>12.5683
            ],

            [
                'name'=>'Finland',
                'code'=>'FIN',
                'region'=>'Europe',
                'currency'=>'EUR',
                'language'=>'Finnish',
                'latitude'=>60.1699,
                'longitude'=>24.9384
            ],

            [
                'name'=>'Iceland',
                'code'=>'ISL',
                'region'=>'Europe',
                'currency'=>'ISK',
                'language'=>'Icelandic',
                'latitude'=>64.1466,
                'longitude'=>-21.9426
            ],

            [
                'name'=>'Ireland',
                'code'=>'IRL',
                'region'=>'Europe',
                'currency'=>'EUR',
                'language'=>'English',
                'latitude'=>53.3498,
                'longitude'=>-6.2603
            ],

            [
                'name'=>'Ukraine',
                'code'=>'UKR',
                'region'=>'Europe',
                'currency'=>'UAH',
                'language'=>'Ukrainian',
                'latitude'=>50.4501,
                'longitude'=>30.5234
            ],

            [
                'name'=>'Russia',
                'code'=>'RUS',
                'region'=>'Europe',
                'currency'=>'RUB',
                'language'=>'Russian',
                'latitude'=>55.7558,
                'longitude'=>37.6173
            ],

            [
                'name'=>'Turkey',
                'code'=>'TUR',
                'region'=>'Europe',
                'currency'=>'TRY',
                'language'=>'Turkish',
                'latitude'=>39.9334,
                'longitude'=>32.8597
            ],

            [
                'name'=>'Serbia',
                'code'=>'SRB',
                'region'=>'Europe',
                'currency'=>'RSD',
                'language'=>'Serbian',
                'latitude'=>44.7866,
                'longitude'=>20.4489
            ],

            [
                'name'=>'Croatia',
                'code'=>'HRV',
                'region'=>'Europe',
                'currency'=>'EUR',
                'language'=>'Croatian',
                'latitude'=>45.8150,
                'longitude'=>15.9819
            ],

            [
                'name'=>'Slovenia',
                'code'=>'SVN',
                'region'=>'Europe',
                'currency'=>'EUR',
                'language'=>'Slovenian',
                'latitude'=>46.0569,
                'longitude'=>14.5058
            ],

            [
                'name'=>'Bosnia and Herzegovina',
                'code'=>'BIH',
                'region'=>'Europe',
                'currency'=>'BAM',
                'language'=>'Bosnian',
                'latitude'=>43.8563,
                'longitude'=>18.4131
            ],

            [
                'name'=>'Albania',
                'code'=>'ALB',
                'region'=>'Europe',
                'currency'=>'ALL',
                'language'=>'Albanian',
                'latitude'=>41.3275,
                'longitude'=>19.8187
            ],

            [
                'name'=>'North Macedonia',
                'code'=>'MKD',
                'region'=>'Europe',
                'currency'=>'MKD',
                'language'=>'Macedonian',
                'latitude'=>41.9981,
                'longitude'=>21.4254
            ],

            [
                'name'=>'Montenegro',
                'code'=>'MNE',
                'region'=>'Europe',
                'currency'=>'EUR',
                'language'=>'Montenegrin',
                'latitude'=>42.4304,
                'longitude'=>19.2594
            ],

            [
                'name'=>'Estonia',
                'code'=>'EST',
                'region'=>'Europe',
                'currency'=>'EUR',
                'language'=>'Estonian',
                'latitude'=>59.4370,
                'longitude'=>24.7536
            ],

            [
                'name'=>'Latvia',
                'code'=>'LVA',
                'region'=>'Europe',
                'currency'=>'EUR',
                'language'=>'Latvian',
                'latitude'=>56.9496,
                'longitude'=>24.1052
            ],

            [
                'name'=>'Lithuania',
                'code'=>'LTU',
                'region'=>'Europe',
                'currency'=>'EUR',
                'language'=>'Lithuanian',
                'latitude'=>54.6872,
                'longitude'=>25.2797
            ],

            [
                'name'=>'Belarus',
                'code'=>'BLR',
                'region'=>'Europe',
                'currency'=>'BYN',
                'language'=>'Belarusian',
                'latitude'=>53.9045,
                'longitude'=>27.5615
            ],

            [
                'name'=>'Moldova',
                'code'=>'MDA',
                'region'=>'Europe',
                'currency'=>'MDL',
                'language'=>'Romanian',
                'latitude'=>47.0105,
                'longitude'=>28.8638
            ],

            [
                'name'=>'Luxembourg',
                'code'=>'LUX',
                'region'=>'Europe',
                'currency'=>'EUR',
                'language'=>'Luxembourgish',
                'latitude'=>49.6116,
                'longitude'=>6.1319
            ],


            [
                'name'=>'Malta',
                'code'=>'MLT',
                'region'=>'Europe',
                'currency'=>'EUR',
                'language'=>'Maltese',
                'latitude'=>35.8989,
                'longitude'=>14.5146
            ],

            [
                'name'=>'Cyprus',
                'code'=>'CYP',
                'region'=>'Europe',
                'currency'=>'EUR',
                'language'=>'Greek',
                'latitude'=>35.1856,
                'longitude'=>33.3823
            ],

            [
                'name'=>'Netherlands',
                'code'=>'NLD',
                'region'=>'Europe',
                'currency'=>'EUR',
                'language'=>'Dutch',
                'latitude'=>52.3676,
                'longitude'=>4.9041
            ],

            [
                'name'=>'Monaco',
                'code'=>'MCO',
                'region'=>'Europe',
                'currency'=>'EUR',
                'language'=>'French',
                'latitude'=>43.7384,
                'longitude'=>7.4246
            ],

            [
                'name'=>'Liechtenstein',
                'code'=>'LIE',
                'region'=>'Europe',
                'currency'=>'CHF',
                'language'=>'German',
                'latitude'=>47.1416,
                'longitude'=>9.5215
            ],

            [
                'name'=>'San Marino',
                'code'=>'SMR',
                'region'=>'Europe',
                'currency'=>'EUR',
                'language'=>'Italian',
                'latitude'=>43.9424,
                'longitude'=>12.4578
            ],

            [
                'name'=>'Andorra',
                'code'=>'AND',
                'region'=>'Europe',
                'currency'=>'EUR',
                'language'=>'Catalan',
                'latitude'=>42.5063,
                'longitude'=>1.5218
            ],

            [
                'name'=>'Vatican City',
                'code'=>'VAT',
                'region'=>'Europe',
                'currency'=>'EUR',
                'language'=>'Italian',
                'latitude'=>41.9029,
                'longitude'=>12.4534
            ],

            /*
            |--------------------------------------------------------------------------
            | AFRIKA
            |--------------------------------------------------------------------------
            */

             [
                'name' => 'Algeria',
                'code' => 'DZA',
                'region' => 'Africa',
                'currency' => 'DZD',
                'language' => 'Arabic',
                'latitude' => '28.0339',
                'longitude' => '1.6596',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Angola',
                'code' => 'AGO',
                'region' => 'Africa',
                'currency' => 'AOA',
                'language' => 'Portuguese',
                'latitude' => '-11.2027',
                'longitude' => '17.8739',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Benin',
                'code' => 'BEN',
                'region' => 'Africa',
                'currency' => 'XOF',
                'language' => 'French',
                'latitude' => '9.3077',
                'longitude' => '2.3158',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Botswana',
                'code' => 'BWA',
                'region' => 'Africa',
                'currency' => 'BWP',
                'language' => 'English',
                'latitude' => '-22.3285',
                'longitude' => '24.6849',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Burkina Faso',
                'code' => 'BFA',
                'region' => 'Africa',
                'currency' => 'XOF',
                'language' => 'French',
                'latitude' => '12.2383',
                'longitude' => '-1.5616',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Burundi',
                'code' => 'BDI',
                'region' => 'Africa',
                'currency' => 'BIF',
                'language' => 'French',
                'latitude' => '-3.3731',
                'longitude' => '29.9189',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Cameroon',
                'code' => 'CMR',
                'region' => 'Africa',
                'currency' => 'XAF',
                'language' => 'French',
                'latitude' => '7.3697',
                'longitude' => '12.3547',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Cape Verde',
                'code' => 'CPV',
                'region' => 'Africa',
                'currency' => 'CVE',
                'language' => 'Portuguese',
                'latitude' => '16.5388',
                'longitude' => '-23.0418',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Central African Republic',
                'code' => 'CAF',
                'region' => 'Africa',
                'currency' => 'XAF',
                'language' => 'French',
                'latitude' => '6.6111',
                'longitude' => '20.9394',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Chad',
                'code' => 'TCD',
                'region' => 'Africa',
                'currency' => 'XAF',
                'language' => 'French',
                'latitude' => '15.4542',
                'longitude' => '18.7322',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Comoros',
                'code' => 'COM',
                'region' => 'Africa',
                'currency' => 'KMF',
                'language' => 'Arabic',
                'latitude' => '-11.6455',
                'longitude' => '43.3333',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Democratic Republic of the Congo',
                'code' => 'COD',
                'region' => 'Africa',
                'currency' => 'CDF',
                'language' => 'French',
                'latitude' => '-4.0383',
                'longitude' => '21.7587',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Djibouti',
                'code' => 'DJI',
                'region' => 'Africa',
                'currency' => 'DJF',
                'language' => 'French',
                'latitude' => '11.8251',
                'longitude' => '42.5903',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Egypt',
                'code' => 'EGY',
                'region' => 'Africa',
                'currency' => 'EGP',
                'language' => 'Arabic',
                'latitude' => '26.8206',
                'longitude' => '30.8025',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Equatorial Guinea',
                'code' => 'GNQ',
                'region' => 'Africa',
                'currency' => 'XAF',
                'language' => 'Spanish',
                'latitude' => '1.6508',
                'longitude' => '10.2679',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Eritrea',
                'code' => 'ERI',
                'region' => 'Africa',
                'currency' => 'ERN',
                'language' => 'Arabic',
                'latitude' => '15.1794',
                'longitude' => '39.7823',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Eswatini',
                'code' => 'SWZ',
                'region' => 'Africa',
                'currency' => 'SZL',
                'language' => 'English',
                'latitude' => '-26.5225',
                'longitude' => '31.4659',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Ethiopia',
                'code' => 'ETH',
                'region' => 'Africa',
                'currency' => 'ETB',
                'language' => 'Amharic',
                'latitude' => '9.1450',
                'longitude' => '40.4897',
                'created_at' => now(),
                'updated_at' => now(),
            ],

                    /*
        |--------------------------------------------------------------------------
        | AMERICA
        |--------------------------------------------------------------------------
        */


        [
            'name'=>'United States',
            'code'=>'USA',
            'region'=>'America',
            'currency'=>'USD',
            'language'=>'English',
            'latitude'=>38.9072,
            'longitude'=>-77.0369
        ],

        [
            'name'=>'Canada',
            'code'=>'CAN',
            'region'=>'America',
            'currency'=>'CAD',
            'language'=>'English/French',
            'latitude'=>45.4215,
            'longitude'=>-75.6972
        ],

        [
            'name'=>'Mexico',
            'code'=>'MEX',
            'region'=>'America',
            'currency'=>'MXN',
            'language'=>'Spanish',
            'latitude'=>19.4326,
            'longitude'=>-99.1332
        ],

        [
            'name'=>'Guatemala',
            'code'=>'GTM',
            'region'=>'America',
            'currency'=>'GTQ',
            'language'=>'Spanish',
            'latitude'=>14.6349,
            'longitude'=>-90.5069
        ],

        [
            'name'=>'Belize',
            'code'=>'BLZ',
            'region'=>'America',
            'currency'=>'BZD',
            'language'=>'English',
            'latitude'=>17.5046,
            'longitude'=>-88.1962
        ],

        [
            'name'=>'Honduras',
            'code'=>'HND',
            'region'=>'America',
            'currency'=>'HNL',
            'language'=>'Spanish',
            'latitude'=>14.0723,
            'longitude'=>-87.1921
        ],

        [
            'name'=>'El Salvador',
            'code'=>'SLV',
            'region'=>'America',
            'currency'=>'USD',
            'language'=>'Spanish',
            'latitude'=>13.6929,
            'longitude'=>-89.2182
        ],

        [
            'name'=>'Nicaragua',
            'code'=>'NIC',
            'region'=>'America',
            'currency'=>'NIO',
            'language'=>'Spanish',
            'latitude'=>12.1150,
            'longitude'=>-86.2362
        ],

        [
            'name'=>'Costa Rica',
            'code'=>'CRI',
            'region'=>'America',
            'currency'=>'CRC',
            'language'=>'Spanish',
            'latitude'=>9.9281,
            'longitude'=>-84.0907
        ],

        [
            'name'=>'Panama',
            'code'=>'PAN',
            'region'=>'America',
            'currency'=>'PAB',
            'language'=>'Spanish',
            'latitude'=>8.9824,
            'longitude'=>-79.5199
        ],

        [
            'name'=>'Cuba',
            'code'=>'CUB',
            'region'=>'America',
            'currency'=>'CUP',
            'language'=>'Spanish',
            'latitude'=>23.1136,
            'longitude'=>-82.3666
        ],

        [
            'name'=>'Jamaica',
            'code'=>'JAM',
            'region'=>'America',
            'currency'=>'JMD',
            'language'=>'English',
            'latitude'=>18.0179,
            'longitude'=>-76.8099
        ],

        [
            'name'=>'Haiti',
            'code'=>'HTI',
            'region'=>'America',
            'currency'=>'HTG',
            'language'=>'French',
            'latitude'=>18.5944,
            'longitude'=>-72.3074
        ],

        [
            'name'=>'Dominican Republic',
            'code'=>'DOM',
            'region'=>'America',
            'currency'=>'DOP',
            'language'=>'Spanish',
            'latitude'=>18.4861,
            'longitude'=>-69.9312
        ],

        [
            'name'=>'Trinidad and Tobago',
            'code'=>'TTO',
            'region'=>'America',
            'currency'=>'TTD',
            'language'=>'English',
            'latitude'=>10.6918,
            'longitude'=>-61.2225
        ],

        [
            'name'=>'Barbados',
            'code'=>'BRB',
            'region'=>'America',
            'currency'=>'BBD',
            'language'=>'English',
            'latitude'=>13.1939,
            'longitude'=>-59.5432
        ],

        [
            'name'=>'Bahamas',
            'code'=>'BHS',
            'region'=>'America',
            'currency'=>'BSD',
            'language'=>'English',
            'latitude'=>25.0343,
            'longitude'=>-77.3963
        ],

        [
            'name'=>'Colombia',
            'code'=>'COL',
            'region'=>'America',
            'currency'=>'COP',
            'language'=>'Spanish',
            'latitude'=>4.7110,
            'longitude'=>-74.0721
        ],

        [
            'name'=>'Venezuela',
            'code'=>'VEN',
            'region'=>'America',
            'currency'=>'VES',
            'language'=>'Spanish',
            'latitude'=>10.4806,
            'longitude'=>-66.9036
        ],

        [
            'name'=>'Guyana',
            'code'=>'GUY',
            'region'=>'America',
            'currency'=>'GYD',
            'language'=>'English',
            'latitude'=>6.8013,
            'longitude'=>-58.1551
        ],

        [
            'name'=>'Suriname',
            'code'=>'SUR',
            'region'=>'America',
            'currency'=>'SRD',
            'language'=>'Dutch',
            'latitude'=>5.8520,
            'longitude'=>-55.2038
        ],

        [
            'name'=>'Ecuador',
            'code'=>'ECU',
            'region'=>'America',
            'currency'=>'USD',
            'language'=>'Spanish',
            'latitude'=>-0.1807,
            'longitude'=>-78.4678
        ],

        [
            'name'=>'Peru',
            'code'=>'PER',
            'region'=>'America',
            'currency'=>'PEN',
            'language'=>'Spanish',
            'latitude'=>-12.0464,
            'longitude'=>-77.0428
        ],

        [
            'name'=>'Brazil',
            'code'=>'BRA',
            'region'=>'America',
            'currency'=>'BRL',
            'language'=>'Portuguese',
            'latitude'=>-15.7939,
            'longitude'=>-47.8828
        ],

        [
            'name'=>'Bolivia',
            'code'=>'BOL',
            'region'=>'America',
            'currency'=>'BOB',
            'language'=>'Spanish',
            'latitude'=>-16.5000,
            'longitude'=>-68.1500
        ],

        [
            'name'=>'Paraguay',
            'code'=>'PRY',
            'region'=>'America',
            'currency'=>'PYG',
            'language'=>'Spanish',
            'latitude'=>-25.2637,
            'longitude'=>-57.5759
        ],

        [
            'name'=>'Chile',
            'code'=>'CHL',
            'region'=>'America',
            'currency'=>'CLP',
            'language'=>'Spanish',
            'latitude'=>-33.4489,
            'longitude'=>-70.6693
        ],

        [
            'name'=>'Argentina',
            'code'=>'ARG',
            'region'=>'America',
            'currency'=>'ARS',
            'language'=>'Spanish',
            'latitude'=>-34.6037,
            'longitude'=>-58.3816
        ],

        [
            'name'=>'Uruguay',
            'code'=>'URY',
            'region'=>'America',
            'currency'=>'UYU',
            'language'=>'Spanish',
            'latitude'=>-34.9011,
            'longitude'=>-56.1645
        ],

        [
            'name'=>'Suriname',
            'code'=>'SUR',
            'region'=>'America',
            'currency'=>'SRD',
            'language'=>'Dutch',
            'latitude'=>5.8520,
            'longitude'=>-55.2038
        ],

        [
            'name'=>'Antigua and Barbuda',
            'code'=>'ATG',
            'region'=>'America',
            'currency'=>'XCD',
            'language'=>'English',
            'latitude'=>17.1274,
            'longitude'=>-61.8468
        ],

        [
            'name'=>'Dominica',
            'code'=>'DMA',
            'region'=>'America',
            'currency'=>'XCD',
            'language'=>'English',
            'latitude'=>15.3092,
            'longitude'=>-61.3794
        ],

        [
            'name'=>'Grenada',
            'code'=>'GRD',
            'region'=>'America',
            'currency'=>'XCD',
            'language'=>'English',
            'latitude'=>12.0561,
            'longitude'=>-61.7488
        ],

        [
            'name'=>'Saint Lucia',
            'code'=>'LCA',
            'region'=>'America',
            'currency'=>'XCD',
            'language'=>'English',
            'latitude'=>13.9094,
            'longitude'=>-60.9789
        ],

        [
            'name'=>'Saint Vincent and the Grenadines',
            'code'=>'VCT',
            'region'=>'America',
            'currency'=>'XCD',
            'language'=>'English',
            'latitude'=>13.1600,
            'longitude'=>-61.2248
        ],

                    /*
            |--------------------------------------------------------------------------
            | OCEANIA
            |--------------------------------------------------------------------------
            */


            [
                'name'=>'Australia',
                'code'=>'AUS',
                'region'=>'Oceania',
                'currency'=>'AUD',
                'language'=>'English',
                'latitude'=>-25.2744,
                'longitude'=>133.7751
            ],

            [
                'name'=>'New Zealand',
                'code'=>'NZL',
                'region'=>'Oceania',
                'currency'=>'NZD',
                'language'=>'English',
                'latitude'=>-41.2865,
                'longitude'=>174.7762
            ],

            [
                'name'=>'Papua New Guinea',
                'code'=>'PNG',
                'region'=>'Oceania',
                'currency'=>'PGK',
                'language'=>'English',
                'latitude'=>-9.4438,
                'longitude'=>147.1803
            ],

            [
                'name'=>'Fiji',
                'code'=>'FJI',
                'region'=>'Oceania',
                'currency'=>'FJD',
                'language'=>'English',
                'latitude'=>-18.1416,
                'longitude'=>178.4419
            ],

            [
                'name'=>'Solomon Islands',
                'code'=>'SLB',
                'region'=>'Oceania',
                'currency'=>'SBD',
                'language'=>'English',
                'latitude'=>-9.4456,
                'longitude'=>159.9729
            ],

            [
                'name'=>'Vanuatu',
                'code'=>'VUT',
                'region'=>'Oceania',
                'currency'=>'VUV',
                'language'=>'Bislama',
                'latitude'=>-17.7333,
                'longitude'=>168.3273
            ],

            [
                'name'=>'Samoa',
                'code'=>'WSM',
                'region'=>'Oceania',
                'currency'=>'WST',
                'language'=>'Samoan',
                'latitude'=>-13.8507,
                'longitude'=>-171.7514
            ],

            [
                'name'=>'Tonga',
                'code'=>'TON',
                'region'=>'Oceania',
                'currency'=>'TOP',
                'language'=>'Tongan',
                'latitude'=>-21.1393,
                'longitude'=>-175.2049
            ],

            [
                'name'=>'Kiribati',
                'code'=>'KIR',
                'region'=>'Oceania',
                'currency'=>'AUD',
                'language'=>'English',
                'latitude'=>1.4518,
                'longitude'=>172.9717
            ],

            [
                'name'=>'Micronesia',
                'code'=>'FSM',
                'region'=>'Oceania',
                'currency'=>'USD',
                'language'=>'English',
                'latitude'=>6.9248,
                'longitude'=>158.1610
            ],

            [
                'name'=>'Marshall Islands',
                'code'=>'MHL',
                'region'=>'Oceania',
                'currency'=>'USD',
                'language'=>'English',
                'latitude'=>7.1315,
                'longitude'=>171.1845
            ],

            [
                'name'=>'Palau',
                'code'=>'PLW',
                'region'=>'Oceania',
                'currency'=>'USD',
                'language'=>'English',
                'latitude'=>7.5150,
                'longitude'=>134.5825
            ],

            [
                'name'=>'Nauru',
                'code'=>'NRU',
                'region'=>'Oceania',
                'currency'=>'AUD',
                'language'=>'English',
                'latitude'=>-0.5228,
                'longitude'=>166.9315
            ],

            [
                'name'=>'Tuvalu',
                'code'=>'TUV',
                'region'=>'Oceania',
                'currency'=>'AUD',
                'language'=>'English',
                'latitude'=>-8.5211,
                'longitude'=>179.1982
            ],


        ];

        


        foreach($countries as $country)
        {

            Country::updateOrCreate(

                [
                    'code'=>$country['code']
                ],

                $country

            );

        }


    }

}