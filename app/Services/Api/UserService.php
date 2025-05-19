<?php

namespace App\Services\Api;

use App\Services\BaseService;
use App\Repositories\Api\UserRepository;
use App\Services\Clouds\CloudinaryService;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserService extends BaseService
{
    protected $cloudService;

    public function __construct(
        UserRepository $repository,
        CloudinaryService $cloudService
    ) {
        $this->repository = $repository;
        $this->cloudService = $cloudService;
    }

    public function create(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        
        if (isset($data['image_url'])) {
            $data = $this->handleImageUpload($data);
        }
        
        return $this->repository->create($data);
    }

    public function update($user, array $data)
    {
        if (isset($data['password'])) {
            $this->validateCurrentPassword($user, $data);
            $data['password'] = Hash::make($data['password']);
        }

        if (isset($data['image_url'])) {
            $data = $this->handleImageUpload($data, $user->image_key);
        }

        return $this->repository->update($user, $data);
    }

    protected function handleImageUpload(array $data, ?string $oldPublicId = null)
    {
        try {
            if (!isset($data['image_url']) || !($data['image_url'] instanceof \Illuminate\Http\UploadedFile)) {
                return $data;
            }

            if ($oldPublicId) {
                $this->cloudService->deleteImage($oldPublicId);
            }

            $uploadResult = $this->cloudService->uploadImage(
                $data['image_url']->getRealPath(),
                'user_avatars',
                ['width' => 200, 'height' => 200, 'crop' => 'fill']
            );

            $data['image_url'] = $uploadResult['secure_url'];
            $data['image_key'] = $uploadResult['public_id'];

            return $data;
        } catch (\Exception $e) {
            throw new Exception("Failed to process image upload: " . $e->getMessage());
        }
    }

    protected function validateCurrentPassword($user, array $data)
    {
        if (!isset($data['current_password']) || 
            !Hash::check($data['current_password'], $user->password)) {
            throw new \InvalidArgumentException('Current password is invalid');
        }
    }
}