<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; 
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;   

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return new UserResource(true, 'Data User', $users);
    }
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)  
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
  
        $user = User::create([  
            'name' => $request->name,  
            'email' => $request->email,  
            'password' => Hash::make($request->password),  
            'role' => $request->role,  
        ]);  
  
        return new UserResource(true, 'User Successfully Stored',$user);  
    }
    
    public function show($id){  
        $user=User::findOrFail($id);
        return new UserResource(true, 'Data Found', $user);  
    }  

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',  
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,',  
            'password' => 'sometimes|required|string|min:8',  
            'role' => 'sometimes|required|string',  
        ]);  
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $user = User::findOrFail($id);  
  
        if ($request->has('password')) {  
            $user->password = Hash::make($request->password);  
        }  
  
        $user->update($request->all());  
        return new UserResource(true, 'Data Updated',$user);  
    }
    
    public function destroy($id)  
    {  
        $user= User::find($id);
        $user->delete();  
        return new UserResource(true, 'Data Terhapus',null); 
    }  
}
