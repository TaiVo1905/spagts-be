<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Services\Api\ActivityLogService;
use App\Http\Resources\Api\ActivityLogResource;
use App\Http\Filters\Api\ActivityLogFilter;

class ActivityLogController extends BaseController
{
    public function __construct(ActivityLogService $service, Request $request)
    {
        parent::__construct($service, ActivityLogResource::class, $request, ActivityLogFilter::class);
    }
}
