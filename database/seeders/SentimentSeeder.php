<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;

use App\Models\PositiveWord;

use App\Models\NegativeWord;



class SentimentSeeder extends Seeder
{


public function run()
{


$positive=[

'growth',

'increase',

'profit',

'stable',

'improve',

'success',

'expansion',

'investment',

'strong',

'recovery',

'boost',

'agreement',

'partnership'

];



foreach($positive as $word)
{

PositiveWord::create([

'word'=>$word

]);

}




$negative=[

'war',

'crisis',

'inflation',

'delay',

'disaster',

'conflict',

'ban',

'banned',

'sanction',

'sanctions',

'restriction',

'restrict',

'collapse',

'shortage',

'disruption',

'disrupted',

'strike',

'protest',

'blockade',

'tariff',

'trade war',

'warning',

'risk',

'failure'

];



foreach($negative as $word)
{

NegativeWord::create([

'word'=>$word

]);

}


}


}