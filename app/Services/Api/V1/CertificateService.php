<?php

namespace App\Services\Api\V1;

use App\Services\Api\BaseService;
use App\Repositories\Api\V1\CertificateRepository;


class CertificateService extends BaseService
{
    public function __construct(CertificateRepository $classRepository)
    {
        $this->repository = $classRepository;
    }

   
}
