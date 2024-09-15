<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('weather', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_id')->constrained()->onDelete('cascade');

            $table->string('main');
            $table->string('description');
            $table->string('icon');
            $table->float('temp');
            $table->float('feels_like');
            $table->float('temp_min');
            $table->float('temp_max');
            $table->integer('pressure');
            $table->integer('humidity');
            $table->integer('sea_level')->nullable();
            $table->integer('grnd_level')->nullable();
            $table->integer('visibility');
            $table->float('wind_speed');
            $table->integer('wind_deg');
            $table->float('wind_gust')->nullable();
            $table->float('rain_1h')->nullable();
            $table->integer('clouds_all');
            $table->dateTime('dt');
            $table->integer('timezone');
            $table->string('country');
            $table->dateTime('sunrise');
            $table->dateTime('sunset');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weather');
    }
};
