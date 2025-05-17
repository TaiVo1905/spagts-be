<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\ModuleRequest;
use App\Http\Resources\Api\V1\ModuleResource;
use App\Services\Api\V1\ModuleService;

class ModuleController extends BaseController
{
    public function __construct(
        ModuleService $service,
        ModuleRequest $request
    ) {
        parent::__construct($service, ModuleResource::class, $request, null);
    }
}