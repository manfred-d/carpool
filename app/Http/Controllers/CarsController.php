<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    //
    public function index()
    {
        // Logic to fetch and display a list of posts
        try {
            $cars = Cars::all();
            return response()->json([
                'success' => true,
                'message' => 'Cars fetched successfully',
                'cars' => $cars
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'success' => false,
                'message' => 'Cars fetch failed'
            ], 500);
        }
    }

    public function create()
    {
        // Logic to display the form for creating a new post
    }

    public function store(Request $request)
    {
        // Logic to store a new post
        try {

            $validatedData = $request->validate([
                'brand' => 'required|string|max:255',
                'year' => 'required|integer',
                'car_model_id' => 'required|integer',
                'license_plate' => 'required|string|max:255',
                'capacity' => 'required|integer',
                'color' => 'required|string|max:255',
                'user_id' => 'required|integer',
            ]);

            $car = Cars::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Car created successfully',
                'car' => $car
            ], 201);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'success' => false,
                'message' => 'Car creation failed',
                'error' => $th
            ], 500);
        }
    }

    public function show($id)
    {
        // Logic to display a specific post
        try {
            $car = Cars::find($id);

            if (!$car) {
                return response()->json([
                    'message' => 'Car not found'
                ], 404);
            }
            return response()->json([
                'success' => true,
                'message' => 'Car fetched successfully',
                'car' => $car
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                "success" => false,
                'message' => 'Car fetch failed'
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
        try {
            $car = Cars::find($id);

            if (!$car) {
                return response()->json([
                    'message' => 'Car not found'
                ], 404);
            }

            $car->delete();

            return response()->json([
                'success' => true,
                'message' => 'Car deleted successfully'
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'success' => false,
                'message' => 'Car deletion failed'
            ], 500);
        }
    }
}
