<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CityControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the create method returns the correct view.
     *
     * @return void
     */
    public function test_create_method_returns_create_view()
    {
        // Call the create method
        $response = $this->get(route('cities.create'));

        // Assert that the view 'cities.create' is returned
        $response->assertStatus(200);
        $response->assertViewIs('cities.create');
    }

    /**
     * Test the store method saves city data and redirects with a success message.
     *
     * @return void
     */
    public function test_store_method_saves_city_and_redirects()
    {
        // Data to send with the POST request
        $data = [
            'name' => 'Almaty',
            'latitude' => 43.238949,
            'longitude' => 76.889709,
        ];

        // Send the POST request to store the city
        $response = $this->post(route('cities.store'), $data);

        // Assert the city is stored in the database
        $this->assertDatabaseHas('cities', [
            'name' => 'Almaty',
            'latitude' => 43.238949,
            'longitude' => 76.889709,
        ]);

        // Assert that the response redirects back with a success message
        $response->assertRedirect();
        $response->assertSessionHas('success', 'City saved successfully!');
    }

    /**
     * Test validation errors in the store method.
     *
     * @return void
     */
    public function test_store_method_validates_input()
    {
        // Send a POST request with invalid data
        $response = $this->post(route('cities.store'), [
            'name' => '',
            'latitude' => 'invalid',
            'longitude' => null,
        ]);

        // Assert validation errors are returned
        $response->assertSessionHasErrors(['name', 'latitude', 'longitude']);
    }
}
