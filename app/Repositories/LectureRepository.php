<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\LectureActivity;

class LectureRepository
{
    public function getAllLectures()
    {
        return User::where('role', 'lectures')->get();
    }

    public function getActivities($lectureId)
    {
        return LectureActivity::where('lecture_id', $lectureId)->get();
    }

    public function createActivity($lectureId, array $data)
    {
        return LectureActivity::create([
            'lecture_id' => $lectureId,
            'student_id' => $data['student_id'],
            'notes' => $data['notes']
        ]);
    }

    public function review($lectureId, array $data)
    {
        return LectureActivity::create([
            'lecture_id' => $lectureId,
            'student_id' => $data['student_id'],
            'notes' => 'REVIEW: ' . $data['review']
        ]);
    }

    public function approve($lectureId, array $data)
    {
        return LectureActivity::create([
            'lecture_id' => $lectureId,
            'student_id' => $data['student_id'],
            'notes' => 'APPROVED: Final project approved.'
        ]);
    }
}