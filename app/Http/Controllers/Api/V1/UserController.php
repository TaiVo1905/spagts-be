<?php

namespace App\Http\Controllers\Api\V1;

use App\Services\Api\V1\UserService;
use App\Http\Resources\Api\V1\UserResource;
use App\Http\Requests\Api\V1\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{
    public function __construct(UserService $service, UserRequest $request)
    {
        parent::__construct($service, UserResource::class, $request);
    }

    public function updatePassword(UserRequest $request, $id)
    {
        $user = $this->service->find($id);

        if (!Hash::check($request->current_password, $user->password)) {
            return $this->errorResponse('Current password is incorrect', 400);
        }

        $user->password = Hash::make($request->new_password);
        $this->service->update($user, ['password' => $user->password]);

        return $this->successResponse(new $this->resource($user), 'Password updated successfully');
    }

}
