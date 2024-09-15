<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Weather;
use Illuminate\Http\Request;

class WeatherController extends Controller
{

    public function store(Request $request)
    {
        $city = City::firstOrCreate([
            'name' => $request->name,
        ], [
            'latitude' => $request->coord['lat'],
            'longitude' => $request->coord['lon'],
        ]);

        Weather::create([
            'city_id' => $city->id,
            'main' => $request->weather[0]['main'],
            'description' => $request->weather[0]['description'],
            'icon' => $request->weather[0]['icon'],
            'temp' => $request->main['temp'],
            'feels_like' => $request->main['feels_like'],
            'temp_min' => $request->main['temp_min'],
            'temp_max' => $request->main['temp_max'],
            'pressure' => $request->main['pressure'],
            'humidity' => $request->main['humidity'],
            'sea_level' => $request->main['sea_level'] ?? null,
            'grnd_level' => $request->main['grnd_level'] ?? null,
            'visibility' => $request->visibility,
            'wind_speed' => $request->wind['speed'],
            'wind_deg' => $request->wind['deg'],
            'wind_gust' => $request->wind['gust'] ?? null,
            'rain_1h' => $request->rain['1h'] ?? null,
            'clouds_all' => $request->clouds['all'],
            'dt' => $request->dt,
            'timezone' => $request->timezone,
            'country' => $request->sys['country'],
            'sunrise' => $request->sys['sunrise'],
            'sunset' => $request->sys['sunset'],
        ]);

        return response()->json(['message' => 'Weather data saved successfully']);
    }
}
