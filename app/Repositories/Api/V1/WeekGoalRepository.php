<?php

namespace App\Repositories\Api\V1;

use App\Models\WeekGoal;
use App\Repositories\BaseRepository;

class WeekGoalRepository extends BaseRepository
{
      public function __construct(WeekGoal $model)
    {
        parent::__construct($model);
    }
}