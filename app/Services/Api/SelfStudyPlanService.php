<?php

namespace App\Services\Api;

use App\Services\BaseService;
use App\Repositories\Api\SelfStudyPlanRepository;
use App\Services\Clouds\CloudinaryService;

class SelfStudyPlanService extends BaseService
{
    public function __construct(SelfStudyPlanRepository $repository)
    {
        $this->repository = $repository;
    }

    // public function getAll()
    // {
    //     return $this->repository->getAll();
    // }

}
