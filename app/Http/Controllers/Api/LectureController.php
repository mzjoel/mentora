<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\LectureService;
use App\Http\Resources\LectureResource;
use App\Http\Resources\LectureActivityResource;

class LectureController extends Controller
{
    protected $lectureService;

    public function __construct(LectureService $lectureService)
    {
        $this->lectureService = $lectureService;
    }

    public function index()
    {
        return LectureResource::collection($this->lectureService->getAllLectures());
    }

    public function activities($id)
    {
        return LectureActivityResource::collection($this->lectureService->getActivities($id));
    }

    public function storeActivity(Request $request, $id)
    {
        $request->validate([
            'student_id' => 'required|exists:users,id',
            'notes' => 'required|string',
        ]);
        $activity = $this->lectureService->createActivity($id, $request->all());
        return new LectureActivityResource($activity);
    }

    public function review(Request $request, $id)
    {
        $request->validate([
            'student_id' => 'required|exists:users,id',
            'review' => 'required|string',
        ]);
        $activity = $this->lectureService->review($id, $request->all());
        return new LectureActivityResource($activity);
    }

    public function approve(Request $request, $id)
    {
        $request->validate([
            'student_id' => 'required|exists:users,id',
        ]);
        $activity = $this->lectureService->approve($id, $request->all());
        return new LectureActivityResource($activity);
    }
}
