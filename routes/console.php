<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

$updateTime = config('weather.update_time');
\Illuminate\Support\Facades\Schedule::job(new \App\Jobs\UpdateCityWeather())->$updateTime();
