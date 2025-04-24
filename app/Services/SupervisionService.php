<?php

namespace App\Services;  
  
use App\Repositories\SupervisionRepository;  
  
class SupervisionService  
{  
    protected $supervisionRepository;  
  
    public function __construct(SupervisionRepository $supervisionRepository)  
    {  
        $this->supervisionRepository = $supervisionRepository;  
    }  
  
    public function addSupervision(array $data)  
    {  
        return $this->supervisionRepository->create($data);  
    }  
  
    public function getSupervision($id)  
    {  
        return $this->supervisionRepository->findById($id);  
    }  
  
    public function updateSupervision($id, array $data)  
    {  
        $supervision = $this->supervisionRepository->findById($id);  
        return $this->supervisionRepository->update($supervision, $data);  
    }  
  
    public function listSupervisions()  
    {  
        return $this->supervisionRepository->getAllSupervisions();  
    }  
}  