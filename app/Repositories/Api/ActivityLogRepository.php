<?php

namespace App\Repositories\Api;

use App\Models\ActivityLog; 
use App\Repositories\BaseRepository;

class ActivityLogRepository extends BaseRepository
{
    public function __construct(ActivityLog $model)
    {
        parent::__construct($model);
    }
}
