<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ProjectService;  
use App\Http\Resources\ProjectResource;  
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    protected $projectService;  
  
    public function __construct(ProjectService $projectRepository)  
    {  
        $this->projectRepository = $projectRepository;  
    }  
  
    public function index()  
    {  
        return ProjectResource::collection($this->projectRepository->getAllProject());  
    }  
  
    public function show($id)  
    {  
        return new ProjectResource($this->projectRepository->getProject($id));  
    }  
  
    public function store(Request $request)  
    {  
        $request->validate([  
            'student_id' => 'required|exists:users,id',  
            'title' => 'required|string|max:255',  
            'description' => 'nullable|string',  
        ]);  
  
        $project = $this->projectRepository->createProject($request->all());  
        return new ProjectResource($project);  
    }  
  
    public function update(Request $request, $id)  
    {  
        $request->validate([  
            'title' => 'sometimes|required|string|max:255',  
            'description' => 'sometimes|nullable|string',  
        ]);  
  
        $project = $this->projectRepository->updateProject($id, $request->all());  
        return new ProjectResource($project);  
    }  
      
}
