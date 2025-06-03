<?php

namespace App\Services\Api;

use App\Services\BaseService;
use App\Repositories\Api\ActivityLogRepository;
use App\Services\Clouds\CloudinaryService;

class ActivityLogService extends BaseService
{
    public function __construct(ActivityLogRepository $repository)
    {
        $this->repository = $repository;
    }
}