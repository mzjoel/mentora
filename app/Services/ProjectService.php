<?php
namespace App\Services;  
  
use App\Repositories\ProjectRepository;  
  
class ProjectService  
{  
    protected $projectRepository;  
  
    public function __construct(ProjectRepository $projectRepository)  
    {  
        $this->projectRepository = $projectRepository;  
    }  
  
    public function createProject(array $data)
    {
        return $this->projectRepository->create($data); 
    } 
  
    public function getProject($id)  
    {  
        return $this->projectRepository->findById($id);  
    }  
  
    public function updateProject($id, array $data)  
    {  
        $proposal = $this->projectRepository->findById($id);  
        return $this->projectRepository->update($proposal, $data);  
    }  
  
    public function getAllProject()  
    {  
        return $this->projectRepository->getAllProject();  
    }  
}  