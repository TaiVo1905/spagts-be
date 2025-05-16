<?php

namespace App\Services\Api\V1;

use App\Services\Api\BaseService;
use App\Repositories\Api\V1\UserRepository;
use App\Services\Clouds\CloudinaryService;

class UserService extends BaseService
{
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        return $this->repository->create($data);
    }

    public function update($user, array $data)
    {
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }
        // if(isset($data['image_url'])) {
        //     $data['image_key'] = CloudinaryService::uploadImage($data['image_url'])->getPublicId();
        // }
        return $this->repository->update($user, $data);
    }

    public function delete($user)
    {
        // $cloudinaryService = new CloudinaryService();
        // if($user->image_key) $cloudinaryService->deleteImage($user->image_key);
        return $this->repository->delete($user);
    }

    
}
