<?php

namespace App\Services\Api\V1;

use App\Services\Api\BaseService;
use App\Repositories\Api\V1\CertificateRepository;
use App\Services\Clouds\CloudinaryService;


class CertificateService extends BaseService
{
    protected $cloudService;

    public function __construct(CertificateRepository $repository, CloudinaryService $cloudService)
    {
        $this->repository = $repository;
        $this->cloudService = $cloudService;
    }

    public function create(array $data)
    {
        if (isset($data['imageUrl']) && $data['imageUrl'] instanceof \Illuminate\Http\UploadedFile) {
            $uploadResult = $this->cloudService->uploadImage(
                $data['imageUrl']->getRealPath(),
                'certificates',
                ['width' => 800, 'height' => 600, 'crop' => 'fill']
            );
            $data['image_key'] = $uploadResult['public_id'];
            unset($data['imageUrl']);
        }

        $data['student_id'] = auth()->id();
        return $this->repository->create($data);
    }

    public function update($certificate, array $data)
    {
        if (isset($data['imageUrl']) && $data['imageUrl'] instanceof \Illuminate\Http\UploadedFile) {
            if ($certificate->image_key) {
                $this->cloudService->deleteImage($certificate->image_key);
            }
            
            $uploadResult = $this->cloudService->uploadImage(
                $data['imageUrl']->getRealPath(),
                'certificates',
                ['width' => 800, 'height' => 600, 'crop' => 'fill']
            );
            $data['image_key'] = $uploadResult['public_id'];
            unset($data['imageUrl']);
        }

        return $this->repository->update($certificate, $data);
    }

    public function delete($certificate)
    {
        if ($certificate->image_key) {
            $this->cloudService->deleteImage($certificate->image_key);
        }
        return $this->repository->delete($certificate);
    }
}
