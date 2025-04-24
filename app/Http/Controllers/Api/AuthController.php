<?php

namespace App\Http\Controllers\Api;

use App\Services\UserService;  
use App\Http\Resources\UserResource;  
use Illuminate\Http\Request;  
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator; 

class AuthController extends Controller
{
    protected $userService;  
  
    public function __construct(UserService $userService)  
    {  
        $this->userService = $userService;  
    }  
  
    public function register(Request $request)  
    {  
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',  
            'email' => 'required|string|email|max:255|unique:users',  
            'password' => 'required|string|min:8',  
            'role' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }  
  
        $user = $this->userService->register($request->all());  
        return new UserResource(true, 'User registered successfully', $user); 
    }  
  
    public function login(Request $request)  
    {  
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users',  
            'password' => 'required|string|min:8',  
        ]); 
  
        $user = $this->userService->login($request->all());  
  
        
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
        ], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ]);
    }  
  
    public function getUser()  
    {  
        return response()->json(Auth::user());  
    }  
  
    public function updateUser(Request $request)  
    {  
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',  
            'email' => 'required|string|email|max:255|unique:users',  
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }  
  
        $user = $this->userService->updateUser(Auth::id(), $request->all());  
        return new UserResource(true, 'Updated Successfully', $user); 
    }  
  
    public function logout()  
    {  
        Auth::user()->tokens()->delete();  
        return new UserResource(true, 'LogOut Successfylly', null);   
    }  
}
