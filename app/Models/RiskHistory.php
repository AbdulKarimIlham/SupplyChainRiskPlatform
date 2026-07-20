<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class RiskHistory extends Model
{


protected $fillable=[

'country_id',

'total_score',

'status',

'date'

];



public function country()
{

return $this->belongsTo(Country::class);

}


}