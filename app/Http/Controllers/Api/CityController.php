<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

/**
 * @OA\Info(title="City API", version="1.0.0")
 */
class CityController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/cities",
     *     summary="Get a list of cities with their weather data",
     *     tags={"Cities"},
     *     @OA\Response(
     *         response=200,
     *         description="A list of cities with their weather data",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Astana"),
     *                 @OA\Property(property="latitude", type="number", format="float", example=51.1694),
     *                 @OA\Property(property="longitude", type="number", format="float", example=71.4491),
     *                 @OA\Property(
     *                     property="weathers",
     *                     type="array",
     *                     @OA\Items(
     *                         @OA\Property(property="main", type="string", example="Clouds"),
     *                         @OA\Property(property="description", type="string", example="broken clouds"),
     *                         @OA\Property(property="icon", type="string", example="04n"),
     *                         @OA\Property(property="temp", type="number", format="float", example=286.14),
     *                         @OA\Property(property="feels_like", type="number", format="float", example=285.79),
     *                         @OA\Property(property="temp_min", type="number", format="float", example=286.14),
     *                         @OA\Property(property="temp_max", type="number", format="float", example=286.14),
     *                         @OA\Property(property="pressure", type="integer", example=1022),
     *                         @OA\Property(property="humidity", type="integer", example=88),
     *                         @OA\Property(property="sea_level", type="integer", example=1022),
     *                         @OA\Property(property="grnd_level", type="integer", example=980),
     *                         @OA\Property(property="visibility", type="integer", example=10000),
     *                         @OA\Property(property="wind_speed", type="number", format="float", example=6.0),
     *                         @OA\Property(property="wind_deg", type="integer", example=50),
     *                         @OA\Property(property="wind_gust", type="number", format="float", example=7.5),
     *                         @OA\Property(property="rain_1h", type="number", format="float", example=3.16),
     *                         @OA\Property(property="clouds_all", type="integer", example=75),
     *                         @OA\Property(property="dt", type="string", format="date-time", example="2024-09-15T12:34:56Z"),
     *                         @OA\Property(property="timezone", type="integer", example=18000),
     *                         @OA\Property(property="country", type="string", example="KZ"),
     *                         @OA\Property(property="sunrise", type="string", format="date-time", example="2024-09-15T06:00:00Z"),
     *                         @OA\Property(property="sunset", type="string", format="date-time", example="2024-09-15T18:00:00Z"),
     *                     )
     *                 ),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *     ),
     * )
     */
    public function index()
    {
        return City::with('weathers')->get();
    }

    /**
     * @OA\Get(
     *     path="/api/cities/{id}",
     *     summary="Get a specific city with its weather data",
     *     tags={"Cities"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the city",
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="City with its weather data",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="Astana"),
     *             @OA\Property(property="latitude", type="number", format="float", example=51.1694),
     *             @OA\Property(property="longitude", type="number", format="float", example=71.4491),
     *             @OA\Property(
     *                 property="weathers",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="main", type="string", example="Clouds"),
     *                     @OA\Property(property="description", type="string", example="broken clouds"),
     *                     @OA\Property(property="icon", type="string", example="04n"),
     *                     @OA\Property(property="temp", type="number", format="float", example=286.14),
     *                     @OA\Property(property="feels_like", type="number", format="float", example=285.79),
     *                     @OA\Property(property="temp_min", type="number", format="float", example=286.14),
     *                     @OA\Property(property="temp_max", type="number", format="float", example=286.14),
     *                     @OA\Property(property="pressure", type="integer", example=1022),
     *                     @OA\Property(property="humidity", type="integer", example=88),
     *                     @OA\Property(property="sea_level", type="integer", example=1022),
     *                     @OA\Property(property="grnd_level", type="integer", example=980),
     *                     @OA\Property(property="visibility", type="integer", example=10000),
     *                     @OA\Property(property="wind_speed", type="number", format="float", example=6.0),
     *                     @OA\Property(property="wind_deg", type="integer", example=50),
     *                     @OA\Property(property="wind_gust", type="number", format="float", example=7.5),
     *                     @OA\Property(property="rain_1h", type="number", format="float", example=3.16),
     *                     @OA\Property(property="clouds_all", type="integer", example=75),
     *                     @OA\Property(property="dt", type="string", format="date-time", example="2024-09-15T12:34:56Z"),
     *                     @OA\Property(property="timezone", type="integer", example=18000),
     *                     @OA\Property(property="country", type="string", example="KZ"),
     *                     @OA\Property(property="sunrise", type="string", format="date-time", example="2024-09-15T06:00:00Z"),
     *                     @OA\Property(property="sunset", type="string", format="date-time", example="2024-09-15T18:00:00Z"),
     *                 )
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="City not found",
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *     ),
     * )
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
