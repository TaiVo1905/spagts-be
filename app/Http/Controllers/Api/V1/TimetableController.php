<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\TimetableRequest;
use App\Http\Resources\Api\V1\TimetableResource;
use App\Services\Api\V1\TimetableService;
use App\Http\Filters\Api\V1\TimetableFilter;

class TimetableController extends BaseController
{
    public function __construct(
        TimetableService $service,
        TimetableRequest $request,
    ) {
        parent::__construct($service, TimetableResource::class, $request, $filter = null);
    }
}