<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AdvisoryService;
use App\Http\Resources\AdvisoryResource;
use Illuminate\Http\Request;
use App\Models\Advisory; 

  
class AdvisoryController extends Controller 
{  
    protected $advisoryService;  
  
    public function __construct(AdvisoryService $advisoryService)  
    {  
        $this->advisoryService = $advisoryService;  
    }  
  
    public function index()  
    {  
        $advisory = $this->advisoryService->getAllAdvisories();
        return new AdvisoryResource(true, 'Data retrieved successfully', $advisory);
    }  
  
    public function show($id)  
    {  
        $advisory = $this->advisoryService->getAdvisory($id);
        return new AdvisoryResource(true, 'Project retrieved successfully', $advisory);
    }  
  
    public function store(Request $request)  
    {  
        $request->validate([  
            'student_id' => 'required|exists:users,id',  
            'advisor_id' => 'required|exists:users,id',  
            'topic' => 'required|string|min:10|max:255',
        ]);

        if (Advisory::where('student_id', $request->student_id)->where('advisor_id', $request->advisor_id)->whereNull('response')->exists()) {
            return response()->json(['error' => 'You already have an active advisory with this advisor.'], 400);
        }  
  
        $advisory = $this->advisoryService->createAdvisory($request->all());  
        return response()->json([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'data' => new AdvisoryResource(true, 'Data retrieved successfully', $advisory),
        ]); 
    }  
  
    public function respond(Request $request, $id)  
    {  
        $request->validate([  
            'response' => 'required|string',  
        ]);  
  
        $advisory = $this->advisoryService->updateAdvisory($id, ['response' => $request->response]);  
        return response()->json([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'data' => new AdvisoryResource(true, 'Data retrieved successfully', $advisory),
        ]); 
    }  
}  
