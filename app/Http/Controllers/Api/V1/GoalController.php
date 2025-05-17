<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Filters\Api\V1\GoalFilter;
use App\Http\Requests\Api\V1\GoalRequest;
use App\Http\Resources\Api\V1\GoalResource;
use App\Services\Api\V1\GoalService;

class GoalController extends BaseController
{
    public function __construct(
        GoalService $service,
        GoalRequest $request
    ) {
        parent::__construct($service, GoalResource::class, $request, null::class);
    }
}
