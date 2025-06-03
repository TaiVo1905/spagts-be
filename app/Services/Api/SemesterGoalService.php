<?php

namespace App\Services\Api;

use App\Repositories\Api\SemesterGoalRepository;
use App\Services\BaseService;

class SemesterGoalService extends BaseService
{
    public function __construct(SemesterGoalRepository $repository)
    {
        $this->repository = $repository;
    }
}