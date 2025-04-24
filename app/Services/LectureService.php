<?php

// app/Services/LectureService.php
namespace App\Services;

use App\Repositories\LectureRepository;

class LectureService
{
    protected $lectureRepo;

    public function __construct(LectureRepository $lectureRepo)
    {
        $this->lectureRepo = $lectureRepo;
    }

    public function getAllLectures()
    {
        return $this->lectureRepo->getAllLectures();
    }

    public function getActivities($id)
    {
        return $this->lectureRepo->getActivities($id);
    }

    public function createActivity($id, $data)
    {
        return $this->lectureRepo->createActivity($id, $data);
    }

    public function review($id, $data)
    {
        return $this->lectureRepo->review($id, $data);
    }

    public function approve($id, $data)
    {
        return $this->lectureRepo->approve($id, $data);
    }
}
