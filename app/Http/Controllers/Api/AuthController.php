<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $userService;  
  
    public function __construct(UserService $userService)  
    {  
        $this->userService = $userService;  
    }  
  
    public function register(Request $request)  
    {  
        $request->validate([  
            'name' => 'required|string|max:255',  
            'email' => 'required|string|email|max:255|unique:users',  
            'password' => 'required|string|min:8',  
        ]);  
  
        $user = $this->userService->register($request->all());  
        return response()->json($user, 201);  
    }  
  
    public function login(Request $request)  
    {  
        $request->validate([  
            'email' => 'required|string|email',  
            'password' => 'required|string',  
        ]);  
  
        $user = $this->userService->login($request->all());  
  
        if (!$user) {  
            return response()->json(['message' => 'Unauthorized'], 401);  
        }  
  
        $token = $user->createToken('YourAppName')->plainTextToken;  
  
        return response()->json(['token' => $token]);  
    }  
  
    public function getUser()  
    {  
        return response()->json(Auth::user());  
    }  
  
    public function updateUser(Request $request)  
    {  
        $request->validate([  
            'name' => 'sometimes|required|string|max:255',  
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . Auth::id(),  
            'password' => 'sometimes|required|string|min:8',  
        ]);  
  
        $user = $this->userService->updateUser(Auth::id(), $request->all());  
        return response()->json($user);  
    }  
  
    public function logout()  
    {  
        Auth::user()->tokens()->delete();  
        return response()->json(['message' => 'Logged out successfully']);  
    }  
}
