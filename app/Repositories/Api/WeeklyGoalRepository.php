<?php

namespace App\Repositories\Api;

use App\Models\WeeklyGoal;
use App\Repositories\BaseRepository;

class WeeklyGoalRepository extends BaseRepository
{
      public function __construct(WeeklyGoal $model)
    {
        parent::__construct($model);
    }
}