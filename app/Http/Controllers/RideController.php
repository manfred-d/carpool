<?php

namespace App\Http\Controllers;

use App\Models\Rides;
use Illuminate\Http\Request;

class RideController extends Controller
{
    //
    public function getRides()
    {
        // Logic to fetch and display a list of posts
        try {
            $rides = Rides::all();

            return response()->json([
                'success' => true,
                'message' => 'Rides fetched successfully',
                'rides' => $rides
            ], 200);

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'success' => false,
                'message' => 'Rides fetch failed'
            ], 500);
        }
    }

    public function create()
    {
        // Logic to display the form for creating a new post
    }

    public function createRide(Request $request)
    {
        // Logic to store a new ride
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'car_id' => 'required|integer',
                'driver_id' => 'required|integer',
                'phone'=> 'required|string|max:255',
                'available_seats' => 'required|integer',
                'start_location_id' => 'required|integer|max:255',
                'end_location_id' => 'required|integer|max:255',
                'departure_time' => 'required|date',
                'price' => 'required|integer',
                'status' => 'required|string|max:255',
            ]);

            if($validatedData['start_location_id'] == $validatedData['end_location_id']){
                return response()->json([
                    'success' => false,
                    'message' => 'Start and end locations cannot be the same'
                ], 400);
            }
            $ride = Rides::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Ride created successfully',
                'ride' => $ride
            ], 201);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'success' => false,
                'message' => 'Ride creation failed',
                'error' => $th->getMessage()
            ], 500);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'success' => false,
                'message' => 'Ride creation failed',
                'error' => $th->getMessage()
            ], 500);
        }

    }

    public function getRide($id)
    {
        // Logic to display a specific ride
        try {
            $ride = Rides::find($id);

            if (!$ride) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ride not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Ride fetched successfully',
                'ride' => $ride
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'success' => false,
                'message' => 'Ride fetch failed'
            ], 500);
        }
    }

    public function edit($id)
    {
        // Logic to display the form for editing a post
    }

    public function update(Request $request, $id)
    {
        // Logic to update a post
    }

    public function destroy($id)
    {
        // Logic to delete a post
    }
}
