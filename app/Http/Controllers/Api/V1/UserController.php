<?php

namespace App\Http\Controllers\Api\V1;

use App\Services\Api\V1\UserService;
use App\Http\Resources\Api\V1\UserResource;
use App\Http\Requests\Api\V1\UserRequest;

class UserController extends BaseController
{
    public function __construct(UserService $service, UserRequest $request)
    {
        parent::__construct($service, UserResource::class, $request);
    }
}
