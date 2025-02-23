<?php

namespace App\Http\Controllers;

use App\Models\User;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Logic to log a user in
        try {
            
            $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string|min:8'
            ]);

            $user = User::where('email', $request->email)->first();

            
            // Auth::attempt($request->only('email', 'password'))
            if ($user && Hash::check($request->password, $user->password)) {
                // $user = Auth::user();
                $token = $user->createToken('auth_token')->plainTextToken;

                return response()->json([
                    'token' => $token,
                    'user' => $user
                ]);
            }
            

            return response()->json([
                'message' => 'Invalid login credentials'
            ], 401);

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'message' => 'Error occurred!, Login failed',
                'error' => $th
            ], 500);
        }

    }

    public function register(Request $request){
        // Logic to register a user
        try {
            $validator = FacadesValidator::make($request->all(), [
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);

            // If validation fails, return error response
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation error',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $validatedData = $request->all();
            $validatedData['password'] = Hash::make($validatedData['password']);

            $user = User::create($validatedData);

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'User created successfully',
                'user' => $user,
                'token' => $token
            ], 201);

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'message' => 'User creation failed',
                'error' => $th
            ], 500);
        }
    }
}
