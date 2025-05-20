<?php

namespace App\Http\Controllers\Api;

use App\Http\Filters\Api\SemesterGoalFilter;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Api\SemesterGoalRequest;
use App\Http\Resources\Api\SemesterGoalResource;
use App\Services\Api\SemesterGoalService;

class SemesterGoalController extends BaseController
{
    public function __construct(
        SemesterGoalService $service,
        SemesterGoalRequest $request
    ) {
        parent::__construct($service, SemesterGoalResource::class, $request, SemesterGoalFilter::class);
    }
}
