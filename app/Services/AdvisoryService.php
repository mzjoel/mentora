<?php

namespace App\Services;  
  
use App\Repositories\AdvisoryRepository;  
  
class AdvisoryService  
{  
    protected $advisoryRepository;  
  
    public function __construct(AdvisoryRepository $advisoryRepository)  
    {  
        $this->advisoryRepository = $advisoryRepository;  
    }  
  
    public function createAdvisory(array $data)  
    {  
        return $this->advisoryRepository->create($data);  
    }  
  
    public function getAdvisory($id)  
    {  
        return $this->advisoryRepository->findById($id);  
    }  
  
    public function updateAdvisory($id, array $data)  
    {  
        $advisory = $this->advisoryRepository->findById($id);  
        return $this->advisoryRepository->update($advisory, $data);  
    }  
  
    public function getAllAdvisories()  
    {  
        return $this->advisoryRepository->getAllAdvisories();  
    }  
}  