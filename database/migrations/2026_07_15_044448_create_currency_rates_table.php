<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

public function up(): void
{

Schema::create('currency_rates', function(Blueprint $table){


$table->id();


$table->foreignId('country_id')
      ->constrained()
      ->cascadeOnDelete();



$table->string('base_currency');


$table->string('target_currency');



$table->decimal(
    'exchange_rate',
    12,
    4
);



$table->decimal(
    'change_percentage',
    8,
    2
)->nullable();



$table->string(
    'risk_level'
);



$table->date(
    'date'
);



$table->timestamps();



});


}


public function down(): void
{

Schema::dropIfExists(
'currency_rates'
);

}

};