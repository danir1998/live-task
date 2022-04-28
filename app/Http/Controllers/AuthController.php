<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Routing\Controller;

use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()){
            return response(["message" => "Error register action", "errors" => $validator->errors()], 400);
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        $token = $user->createToken('auth')->plainTextToken;

        return response([
            'message' => 'success',
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();

            return response([
                'token' => $user->createToken('auth')->plainTextToken,
                'user' => $user
            ], 200);
        } else{
            return response(['message' => 'Unauthorised'], 401);
        }
    }
}
