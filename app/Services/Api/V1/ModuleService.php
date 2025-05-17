<?php

namespace App\Services\Api\V1;

use App\Services\Api\BaseService;
use App\Repositories\Api\V1\ModuleRepository;
use App\Services\Clouds\CloudinaryService;

class ModuleService extends BaseService
{
    public function __construct(ModuleRepository $repository)
    {
        $this->repository = $repository;
    }


}
