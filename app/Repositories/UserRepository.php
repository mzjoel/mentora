<?php

namespace App\Repositories;  
  
use App\Models\User;  
  
class UserRepository  
{  
    public function create(array $data)  
    {  
        return User::create($data);  
    }  
  
    public function findById($id)  
    {  
        return User::findOrFail($id);  
    }  
  
    public function update(User $user, array $data)  
    {  
        $user->update($data);  
        return $user;  
    }  
  
    public function delete(User $user)  
    {  
        return $user->delete();  
    }  
  
    public function findByEmail($email)  
    {  
        return User::where('email', $email)->first();  
    }  
}  