<?php

namespace App\Services\Api;

use App\Services\BaseService;
use App\Repositories\Api\WeeklyGoalRepository;
use App\Services\Clouds\CloudinaryService;

class WeeklyGoalService extends BaseService
{
    public function __construct(WeeklyGoalRepository $repository)
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