<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ProjectService;  
use App\Http\Resources\ProjectResource;  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    protected $projectService;  
  
    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }
  
    public function index()  
    {  
        $project = $this->projectService->getAllProject();
        return new ProjectResource(true, 'Project retrieved successfully', $project);

    }  
  
    public function show($id)  
    {  
        $project = $this->projectService->getProject($id);
        return new ProjectResource(true, 'Project retrieved successfully', $project);
    }  
  
    public function store(Request $request)  
    {  
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
    
        
        $data = [
            'user_id' => $validated['user_id'],
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'status' => 'pending', 
        ];

        $project = $this->projectService->createProject($validated);
        return response()->json([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'data' => new ProjectResource(true, 'Project retrieved successfully', $project),
        ]);
    }  
  
    public function update(Request $request, $id)  
    {  
        $request->validate([  
            'title' => 'sometimes|required|string|max:255',  
            'description' => 'sometimes|nullable|string',  
        ]);  
  
        $project = $this->projectService->updateProject($id, $request->all());  
        return response()->json([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'data' => new ProjectResource(true, 'Project retrieved successfully', $project),
        ]); 
    }  
      
}
