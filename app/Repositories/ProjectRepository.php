<?php

namespace App\Repositories;  
  
use App\Models\Project;  
  
class ProjectRepository  
{  
    public function create(array $data)  
    {  
        return Project::create($data);  
    }  
  
    public function findById($id)  
    {  
        return Project::findOrFail($id);  
    }  
  
    public function update(Project $proposal, array $data)  
    {  
        $proposal->update($data);  
        return $proposal;  
    }  
  
    public function delete(Project $proposal)  
    {  
        return $proposal->delete();  
    }  
  
    public function getAllProposals()  
    {  
        return Project::all();  
    }  
}  