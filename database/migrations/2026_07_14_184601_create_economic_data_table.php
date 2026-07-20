<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

    public function up(): void
    {

        Schema::create('economic_data', function (Blueprint $table) {


            $table->id();


            $table->foreignId('country_id')
                ->constrained()
                ->cascadeOnDelete();



            $table->decimal(
                'gdp',
                20,
                2
            )->nullable();



            $table->decimal(
                'inflation',
                10,
                2
            )->nullable();



            $table->bigInteger(
                'population'
            )->nullable();



            $table->decimal(
                'export_value',
                20,
                2
            )->nullable();



            $table->decimal(
                'import_value',
                20,
                2
            )->nullable();



            $table->integer(
                'year'
            );



            $table->timestamps();


        });

    }



    public function down(): void
    {

        Schema::dropIfExists(
            'economic_data'
        );

    }

};