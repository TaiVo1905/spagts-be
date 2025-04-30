<?php

namespace App\Services\Clouds;

use Cloudinary;
use Cloudinary\Api\Upload\UploadApi;

class CloudinaryService
{
    public function uploadImage($image)
    {
        $uploaded = (new UploadApi())->upload($image->getRealPath());
        return $uploaded;
    }

    public function deleteImage($publicId)
    {
        $result = (new UploadApi())->destroy($publicId);
        return $result;
    }

    public function getUrl($publicId)
    {
        return Cloudinary::cloudinary_url($publicId);
    }
}
