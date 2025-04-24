<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AgentController extends Controller
{
    public function generateIds(Request $request){
        if (!$request->user()) {  
            return response()->json(['error' => 'Unauthorized'], 401);  
        }  
        $userId = $request->user()->id;
        $userId = (string) Str::uuid();
        $sessionId = (string) Str::uuid();
        $agentId = "56498cb3-870a-47d7-a77f-63faeeb505e3";

        return response()->json([
            'userId' => $userId,
            'sessionId' => $sessionId,
            'agentId' => $agentId,
        ]);
    }

    public function index(){
        return view('agents.index');
    }
}
