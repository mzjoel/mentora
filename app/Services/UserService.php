<?php

namespace App\Services;  
  
use App\Repositories\UserRepository;  
use Illuminate\Support\Facades\Hash;  
  
class UserService  
{  
    protected $userRepository;  
  
    public function __construct(UserRepository $userRepository)  
    {  
        $this->userRepository = $userRepository;  
    }  
  
    public function register(array $data)  
    {  
        $data['password'] = Hash::make($data['password']);  
        return $this->userRepository->create($data);  
    }  
  
    public function updateUser($id, array $data)  
    {  
        $user = $this->userRepository->findById($id);  
        return $this->userRepository->update($user, $data);  
    }  
  
    public function getUser($id)  
    {  
        return $this->userRepository->findById($id);  
    }  
  
    public function login(array $data)  
    {  
        $user = $this->userRepository->findByEmail($data['email']);  
        if ($user && Hash::check($data['password'], $user->password)) {  
            return $user;  
        }  
        return null;  
    }  
}  