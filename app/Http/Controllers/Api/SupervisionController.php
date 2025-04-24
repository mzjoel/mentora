<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\SupervisionService;  
use Illuminate\Http\Request;

class SupervisionController extends Controller
{
    protected $supervisionService;  
  
    public function __construct(SupervisionService $supervisionService)  
    {  
        $this->supervisionService = $supervisionService;  
    }  
  
    public function index()  
    {  
        return response()->json($this->supervisionService->listSupervisions());  
    }  
  
    public function show($id)  
    {  
        return response()->json($this->supervisionService->getSupervision($id));  
    }  
  
    public function addLog(Request $request, $id)  
    {  
        $request->validate([  
            'notes' => 'required|string',  
        ]);  
  
        $data = [  
            'thesis_proposal_id' => $id,  
            'advisor_id' => auth()->id(),   
            'notes' => $request->notes,  
        ];  
  
        $supervision = $this->supervisionService->addSupervision($data);  
        return response()->json($supervision, 201);  
    }  
  
    // public function approveProposal(Request $request, $id)  
    // {  
        
    // }  
  
    // public function readyForDefense(Request $request, $id)  
    // {  
    //     // Logika untuk menyetujui siap sidang  
    // }  
}
