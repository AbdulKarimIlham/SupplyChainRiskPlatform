<?php

namespace App\Services;


use Illuminate\Support\Facades\Http;



class CurrencyService
{


public function getRate(
    $currency
)
{


$response = Http::get(

"https://open.er-api.com/v6/latest/USD"

);



$data=$response->json();



return [

'base'=>'USD',

'target'=>$currency,

'rate'=>
round(
    $data['rates'][$currency] ?? 0,
    2
)

];


}



}