<?php

namespace App\Repositories;  
  
use App\Models\Supervision;  
  
class SupervisionRepository  
{  
    public function create(array $data)  
    {  
        return Supervision::create($data);  
    }  
  
    public function findById($id)  
    {  
        return Supervision::findOrFail($id);  
    }  
  
    public function update(Supervision $supervision, array $data)  
    {  
        $supervision->update($data);  
        return $supervision;  
    }  
  
    public function delete(Supervision $supervision)  
    {  
        return $supervision->delete();  
    }  
  
    public function getAllSupervisions()  
    {  
        return Supervision::all();  
    }  
}  
