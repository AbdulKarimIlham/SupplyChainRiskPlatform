<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Models\RiskScore;


class RiskRankingController extends Controller
{


public function index()
{


$ranking = RiskScore::with('country')

->orderByDesc('total_score')

->get()

->unique('country_id')

->values()

->map(function($item){


return [

"country"=>$item->country->name,

"score"=>$item->total_score,

"status"=>$item->status

];


});



return response()->json([

"success"=>true,

"ranking"=>$ranking

]);


}


}