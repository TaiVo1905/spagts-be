<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Services\Api\V1\ClassService;
use App\Http\Resources\Api\V1\ClassResource;
use App\Http\Requests\Api\V1\ClassNameRequest;
use App\Http\Filters\Api\V1\ClassFilter;


class ClassController extends BaseController
{
    public function __construct(ClassService $service, ClassNameRequest $request,)
    {
        parent::__construct($service, ClassResource::class, $request, ClassFilter::class);
    }
}
