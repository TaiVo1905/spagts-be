<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Services\Api\ClassService;
use App\Http\Resources\Api\ClassResource;
use App\Http\Requests\Api\ClassRequest;
use App\Http\Filters\Api\ClassFilter;


class ClassController extends BaseController
{
    public function __construct(ClassService $service, ClassRequest $request,)
    {
        parent::__construct($service, ClassResource::class, $request, ClassFilter::class);
    }
}
