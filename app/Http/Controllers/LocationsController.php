<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationsController extends Controller
{
    //
    public function index()
    {
        // Logic to fetch and display a list of locations
        try {
            $locations = Location::all();
            return response()->json([
                'success' => true,
                'message' => 'Locations fetched successfully',
                'locations' => $locations
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'success' => false,
                'message' => 'Locations fetch failed',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function create()
    {
        // Logic to display the form for creating a new post
    }

    public function store(Request $request)
    {
        // Logic to store a new location site
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'latitude' => 'required|string|max:255',
                'longitude' => 'required|string|max:255',
            ]);

            $location = Location::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Location created successfully',
                'location' => $location
            ], 201);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'success' => false,
                'message' => 'Location creation failed',
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
