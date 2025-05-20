<?php
namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\TimetableRequest;
use App\Http\Resources\Api\TimetableResource;
use App\Services\Api\TimetableService;
use App\Http\Filters\Api\TimetableFilter;
use App\Http\Controllers\BaseController;

class TimetableController extends BaseController
{
    public function __construct(
        TimetableService $service,
        TimetableRequest $request,
    ) {
        parent::__construct($service, TimetableResource::class, $request, TimetableFilter::class);
    }
}