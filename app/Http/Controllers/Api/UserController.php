<?php

namespace App\Http\Controllers\Api;

use App\Services\Api\UserService;
use App\Http\Resources\Api\UserResource;
use App\Http\Resources\Api\UserCollection;
use App\Http\Requests\Api\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Filters\Api\UserFilter;
use Illuminate\Http\Request;
use App\Services\Clouds\CloudinaryService;
use App\Http\Controllers\BaseController;

class UserController extends BaseController
{
    protected $cloudinaryService;

    public function __construct(UserService $service, UserRequest $request, CloudinaryService $cloudinaryService)
    {
        parent::__construct($service, UserResource::class, $request, UserFilter::class);
        $this->cloudinaryService = $cloudinaryService;
    }
}
