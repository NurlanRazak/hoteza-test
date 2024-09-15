<?php

namespace Tests\Feature;

use App\Models\City;
use App\Models\Weather;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CityApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the index method returns a list of cities with weathers.
     *
     * @return void
     */
    public function test_index_method_returns_cities_with_weathers()
    {
        // Create some cities with weather data
        $city = City::factory()->has(Weather::factory()->count(2), 'weathers')->create();

        // Send a GET request to the API index route
        $response = $this->getJson(route('cities.index'));

        // Assert the response status is 200 OK
        $response->assertStatus(200);

        // Assert the response contains the city and its weather data
        $response->assertJson([
            [
                'id' => $city->id,
                'name' => $city->name,
                'weathers' => $city->weathers->map(function ($weather) {
                    return ['id' => $weather->id];
                })->toArray(),
            ]
        ]);
    }

    /**
     * Test the show method returns a specific city with weathers.
     *
     * @return void
     */
    public function test_show_method_returns_specific_city_with_weathers()
    {
        // Create a city with weather data
        $city = City::factory()->has(Weather::factory()->count(2), 'weathers')->create();

        // Send a GET request to the API show route
        $response = $this->getJson(route('cities.show', $city->id));

        // Assert the response status is 200 OK
        $response->assertStatus(200);

        // Assert the response contains the specific city and its weather data
        $response->assertJson([
            'id' => $city->id,
            'name' => $city->name,
            'weathers' => [
                ['id' => $city->weathers[0]->id],
                ['id' => $city->weathers[1]->id],
            ],
        ]);
    }

    /**
     * Test the show method returns 404 for a non-existing city.
     *
     * @return void
     */
    public function test_show_method_returns_404_for_non_existing_city()
    {
        // Send a GET request for a non-existing city ID
        $response = $this->getJson(route('cities.show', 9999));

        // Assert the response status is 404 Not Found
        $response->assertStatus(404);
    }
}
