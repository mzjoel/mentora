<?php

namespace App\Repositories;  
  
use App\Models\Advisory;  
  
class AdvisoryRepository  
{  
    public function create(array $data)  
    {  
        return Advisory::create($data);  
    }  
  
    public function findById($id)  
    {  
        return Advisory::findOrFail($id);  
    }  
  
    public function update(Advisory $advisory, array $data)  
    {  
        $advisory->update($data);  
        return $advisory;  
    }  
  
    public function delete(Advisory $advisory)  
    {  
        return $advisory->delete();  
    }  
  
    public function getAllAdvisories()  
    {  
        return Advisory::with('student', 'advisor')->get();  
    }  
}  