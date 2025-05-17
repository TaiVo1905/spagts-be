<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Api\V1\InClassService;
use App\Http\Resources\Api\V1\InClassPlanResources;
use App\Http\Requests\Api\V1\InClassPlanRequest;
use App\Http\Filters\Api\V1\InClassPlanFilter;
use App\Models\InClass; 

class InClassController extends BaseController
{
    public function __construct(InClassService $service, InClassPlanRequest $request)
    {
        parent::__construct($service, InClassPlanResources::class, $request, InClassPlanFilter::class);
    }
}
