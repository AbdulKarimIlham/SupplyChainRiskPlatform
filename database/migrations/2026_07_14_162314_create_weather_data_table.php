<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

    public function up(): void
    {

        Schema::create('weather_data', function (Blueprint $table) {


            $table->id();


            $table->foreignId('country_id')
                ->constrained()
                ->cascadeOnDelete();


            $table->decimal(
                'temperature',
                5,
                2
            );


            $table->decimal(
                'rain',
                5,
                2
            )->default(0);



            $table->decimal(
                'wind_speed',
                5,
                2
            );


            $table->string(
                'weather_status'
            );


            $table->string(
                'risk_level'
            );


            $table->timestamps();


        });

    }



    public function down(): void
    {

        Schema::dropIfExists(
            'weather_data'
        );

    }

};