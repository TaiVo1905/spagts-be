<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Services\Api\InClassService;
use App\Http\Resources\Api\InClassPlanResources;
use App\Http\Requests\Api\InClassPlanRequest;
use App\Http\Filters\Api\InClassPlanFilter;
use App\Models\InClass; 

class InClassController extends BaseController
{
    public function __construct(InClassService $service, InClassPlanRequest $request)
    {
        parent::__construct($service, InClassPlanResources::class, $request, InClassPlanFilter::class);
    }
}
