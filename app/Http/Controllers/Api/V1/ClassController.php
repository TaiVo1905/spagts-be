<?php

namespace App\Http\Controllers\Api\V1;
use Illuminate\Http\Request;
use App\Services\Api\V1\ClassService;
use App\Http\Resources\Api\V1\ClassResource;
use App\Http\Requests\Api\V1\ClassNameRequest;


class ClassController extends BaseController
{
    public function __construct(ClassService $service, Request $request)
    {
        parent::__construct($service, ClassResource::class, $request);
    }

}
