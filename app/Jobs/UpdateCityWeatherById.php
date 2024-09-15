<?php

namespace App\Jobs;

use App\Models\City;
use App\Models\Weather;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class UpdateCityWeatherById implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public City $city,
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $lat = $this->city->latitude;
        $lon = $this->city->longitude;
        $apiKey = config('weather.api_key');

        $url = "https://api.openweathermap.org/data/2.5/weather?lat={$lat}&lon={$lon}&appid={$apiKey}";

        $response = Http::get("$url")->json();

        $this->saveWeather($response);
    }

    protected function saveWeather($response)
    {
        $dt = Carbon::createFromTimestamp($response['dt'])->toDateTimeString();

        Weather::create([
            'city_id' => $this->city->id,
            'main' => $response['weather'][0]['main'],
            'description' => $response['weather'][0]['description'],
            'icon' => $response['weather'][0]['icon'],
            'temp' => $response['main']['temp'],
            'feels_like' => $response['main']['feels_like'],
            'temp_min' => $response['main']['temp_min'],
            'temp_max' => $response['main']['temp_max'],
            'pressure' => $response['main']['pressure'],
            'humidity' => $response['main']['humidity'],
            'sea_level' => $response['main']['sea_level'] ?? null,
            'grnd_level' => $response['main']['grnd_level'] ?? null,
            'visibility' => $response['visibility'],
            'wind_speed' => $response['wind']['speed'],
            'wind_deg' => $response['wind']['deg'],
            'rain_1h' => $response['rain']['1h'] ?? null, // Rain may not always be present
            'clouds_all' => $response['clouds']['all'],
            'dt' => $dt,
            'timezone' => $response['timezone'],
            'country' => $response['sys']['country'],
            'sunrise' => Carbon::createFromTimestamp($response['sys']['sunrise'])->toDateTimeString(),
            'sunset' => Carbon::createFromTimestamp($response['sys']['sunset'])->toDateTimeString(),
        ]);
    }
}
