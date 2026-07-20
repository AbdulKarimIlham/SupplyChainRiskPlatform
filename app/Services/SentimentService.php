<?php

namespace App\Services;


use App\Models\PositiveWord;

use App\Models\NegativeWord;



class SentimentService
{


public function analyze($text)
{


$text =
strtolower($text);



$words =
explode(
" ",
$text
);



$positiveScore=0;

$negativeScore=0;



$positiveWords =
PositiveWord::pluck('word')
->toArray();



$negativeWords =
NegativeWord::pluck('word')
->toArray();




foreach($words as $word)
{


if(
in_array(
$word,
$positiveWords
)
)
{

$positiveScore++;

}



if(
in_array(
$word,
$negativeWords
)
)
{

$negativeScore++;

}


}




if(
$positiveScore >
$negativeScore
)
{

return [

'sentiment'=>'Positive',

'score'=>$positiveScore

];

}



elseif(
$negativeScore >
$positiveScore
)
{

return [

'sentiment'=>'Negative',

'score'=>$negativeScore

];

}



else
{

return [

'sentiment'=>'Neutral',

'score'=>0

];

}


}


}