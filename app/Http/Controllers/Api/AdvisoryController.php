<?php
namespace App\Http\Controllers;  
  
use App\Services\AdvisoryService;  
use App\Http\Resources\AdvisoryResource;  
use Illuminate\Http\Request;  
  
class AdvisoryController extends Controller  
{  
    protected $advisoryService;  
  
    public function __construct(AdvisoryService $advisoryService)  
    {  
        $this->advisoryService = $advisoryService;  
    }  
  
    public function index()  
    {  
        return AdvisoryResource::collection($this->advisoryService->getAllAdvisories());  
    }  
  
    public function show($id)  
    {  
        return new AdvisoryResource($this->advisoryService->getAdvisory($id));  
    }  
  
    public function store(Request $request)  
    {  
        $request->validate([  
            'student_id' => 'required|exists:users,id',  
            'advisor_id' => 'required|exists:users,id',  
            'topic' => 'required|string',  
        ]);  
  
        $advisory = $this->advisoryService->createAdvisory($request->all());  
        return new AdvisoryResource($advisory);  
    }  
  
    public function respond(Request $request, $id)  
    {  
        $request->validate([  
            'response' => 'required|string',  
        ]);  
  
        $advisory = $this->advisoryService->updateAdvisory($id, ['response' => $request->response]);  
        return new AdvisoryResource($advisory);  
    }  
}  
