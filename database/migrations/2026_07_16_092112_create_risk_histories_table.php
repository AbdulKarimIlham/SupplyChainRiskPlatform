<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

    public function up(): void
    {

        Schema::create('risk_histories', function (Blueprint $table) {

            $table->id();


            $table->foreignId('country_id')
                  ->constrained()
                  ->cascadeOnDelete();


            $table->integer('total_score');


            $table->string('status');


            $table->date('date');


            $table->timestamps();

        });

    }


    public function down(): void
    {

        Schema::dropIfExists('risk_histories');

    }

};