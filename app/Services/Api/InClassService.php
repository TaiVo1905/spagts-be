<?php

namespace App\Services\Api;

use App\Services\BaseService;
use App\Repositories\Api\InClassRepository;
use App\Services\Clouds\CloudinaryService;

class InClassService extends BaseService
{
    public function __construct(InClassRepository $repository)
    {
        $this->repository = $repository;
    }
}