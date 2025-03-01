<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Models\Rides;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    //
    public function index()
    {
        // Logic to fetch and display a list of bookings
        try {
            
            $bookings = Bookings::all();

            return response()->json([
                'success' =>true,
                'message' => "Bookings fetched successful",
                'data' => $bookings
            ]);

        } catch (\Throwable $th) {
            //throw $th;

        }
    }

    public function create()
    {
        // Logic to display the form for creating a new post
    }

    public function store(Request $request)
    {
        // Logic to store a new booking request
        try {
            
            $validatedData = $request->validate([
                'ride_id' => 'required|integer',
                'passenger_id' => 'required|integer',
                'seats_booked' => 'required|integer',
                'booked_at' => 'required|date',
                'status' => 'required|string|max:255',
            ]);

            $ride = Rides::find($validatedData['ride_id']);

            if(!$ride){
                return response()->json([
                    'success' => false,
                    'message' => 'Ride not found'
                ], 404);
            }
            $driver = $ride->driver_id;

            if($validatedData['passenger_id'] == $driver){
                return response()->json([
                    'success' => false,
                    'message' => 'Driver cannot book his own ride'
                ], 400);
            }

            $booking = Bookings::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Booking created successfully',
                'booking' => $booking
            ], 201);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'success' => false,
                'message' => 'Booking creation failed',
                'error' => $th->getMessage()
            ], 500);
        }

    }

    public function show($id)
    {
        // Logic to display a specific post
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
