<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //logic to get all users
        try {
            $users = User::all();
            return response()->json([
                'message' => 'Users fetched successfully',
                'users' => $users
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'message' => 'Users fetch failed'
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
            ]);

            $validatedData['password'] = bcrypt($validatedData['password']);


            $user = User::create($validatedData);

            return response()->json([
                'message' => 'User created successfully',
                'user' => $user
            ], 201);

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'message' => 'User creation failed'
            ], 500);

        }     




    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //logic to get a single user
        try {
            $user = User::find($id);

            if (!$user) {
                return response()->json([
                    'message' => 'User not found with that user id'
                ], 404);
            }

            return response()->json([
                'message' => 'User fetched successfully',
                'user' => $user
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'message' => 'User fetch failed'
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
