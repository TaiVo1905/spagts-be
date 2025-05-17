<?php

namespace App\Services\Api\V1;

use App\Services\Api\BaseService;
use App\Repositories\Api\V1\SelfStudyPlanRepository;
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
