<?php

namespace App\Services\Api\V1;

use App\Services\Api\BaseService;
use App\Repositories\Api\V1\InClassRespository;
use App\Services\Clouds\CloudinaryService;

class InClassService extends BaseService
{
    public function __construct(InClassRespository $repository)
    {
        $this->repository = $repository;
    }
}