<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class NewsCache extends Model
{

protected $table = 'news_caches';

protected $fillable=[


'country_id',

'title',

'description',

'source',

'sentiment',

'sentiment_score'


];



public function country()
{

return $this->belongsTo(
Country::class
);

}


}