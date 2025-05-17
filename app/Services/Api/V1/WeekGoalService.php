<?php

namespace App\Services\Api\V1;

use App\Services\Api\BaseService;
use App\Repositories\Api\V1\WeekGoalRepository;
use App\Services\Clouds\CloudinaryService;

class WeekGoalService extends BaseService
{
    public function __construct(WeekGoalRepository $repository)
    {
        $this->repository = $repository;
    }

    public function findByStartDateAndUser($startDate, $userId)
    {
        return $this->model->where('start_date', $startDate)
                           ->where('user_id', $userId)
                           ->first();
    }
}