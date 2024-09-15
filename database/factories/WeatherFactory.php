<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Weather;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Weather>
 */
class WeatherFactory extends Factory
{
    protected $model = Weather::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'main' => $this->faker->randomElement(['Clear', 'Clouds', 'Rain', 'Snow', 'Thunderstorm', 'Drizzle']),
            'description' => $this->faker->sentence(),
            'icon' => $this->faker->randomElement(['01d', '02d', '03d', '04d', '01n', '02n', '03n', '04n']),
            'temp' => $this->faker->randomFloat(2, -30, 50), // Temperature in Celsius
            'feels_like' => $this->faker->randomFloat(2, -30, 50),
            'temp_min' => $this->faker->randomFloat(2, -30, 50),
            'temp_max' => $this->faker->randomFloat(2, -30, 50),
            'pressure' => $this->faker->numberBetween(950, 1050), // Atmospheric pressure in hPa
            'humidity' => $this->faker->numberBetween(0, 100), // Percentage
            'sea_level' => $this->faker->optional()->numberBetween(950, 1050), // Optional
            'grnd_level' => $this->faker->optional()->numberBetween(950, 1050), // Optional
            'visibility' => $this->faker->numberBetween(1000, 100000), // Visibility in meters
            'wind_speed' => $this->faker->randomFloat(2, 0, 20), // Wind speed in m/s
            'wind_deg' => $this->faker->numberBetween(0, 360), // Wind direction in degrees
            'wind_gust' => $this->faker->optional()->randomFloat(2, 0, 20), // Optional
            'rain_1h' => $this->faker->optional()->randomFloat(2, 0, 100), // Rain volume for the last hour in mm
            'clouds_all' => $this->faker->numberBetween(0, 100), // Cloud cover percentage
            'dt' => $this->faker->dateTime(), // Timestamp of data collection
            'timezone' => $this->faker->numberBetween(-43200, 43200), // Timezone offset in seconds
            'country' => $this->faker->countryCode(), // Country code
            'sunrise' => $this->faker->dateTime(), // Sunrise time
            'sunset' => $this->faker->dateTime(), // Sunset time
            'city_id' => \App\Models\City::factory(),
        ];
    }
}
