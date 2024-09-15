<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return City::with('weathers')->get();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $city = City::whereId($id)->with('weathers')->first();

        if (!$city) {
            return response()->json(['message' => 'City not found'], 404);
        }

        return $city;
    }

}
