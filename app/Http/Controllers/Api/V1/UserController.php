<?php

namespace App\Http\Controllers\Api\V1;

use App\Services\Api\V1\UserService;
use App\Http\Resources\Api\V1\UserResource;
use App\Http\Resources\Api\V1\UserCollection;
use App\Http\Requests\Api\V1\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Filters\Api\V1\UserFilter;
use Illuminate\Http\Request;
use App\Services\Clouds\CloudinaryService;

class UserController extends BaseController
{
    protected $cloudinaryService;

    public function __construct(UserService $service, UserRequest $request, CloudinaryService $cloudinaryService)
    {
        parent::__construct($service, UserResource::class, $request, UserFilter::class);
        $this->cloudinaryService = $cloudinaryService;
    }
}
