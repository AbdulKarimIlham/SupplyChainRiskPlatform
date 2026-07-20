<?php

namespace App\Services;


use Illuminate\Support\Facades\Http;



class NewsService
{


public function search($keyword)
{


$response =
Http::get(

'https://gnews.io/api/v4/search',

[

'q'=>$keyword,

'token'=>env('GNEWS_KEY'),

'lang'=>'en',

'max'=>10,

'sortby'=>'publishedAt'

]

);



return $response->json();


}


}