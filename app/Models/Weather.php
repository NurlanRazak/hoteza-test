<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_id', 'main', 'description', 'icon', 'temp', 'feels_like',
        'temp_min', 'temp_max', 'pressure', 'humidity', 'sea_level',
        'grnd_level', 'visibility', 'wind_speed', 'wind_deg', 'wind_gust',
        'rain_1h', 'clouds_all', 'dt', 'timezone', 'country', 'sunrise', 'sunset'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
