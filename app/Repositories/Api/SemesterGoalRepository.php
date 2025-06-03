<?php

namespace App\Repositories\Api;

use App\Repositories\BaseRepository;
use App\Models\SemesterGoal;

class SemesterGoalRepository extends BaseRepository
{
    public function __construct(SemesterGoal $model)
    {
        parent::__construct($model);
    }
}
