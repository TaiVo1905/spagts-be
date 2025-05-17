<?php

namespace App\Repositories\Api\V1;

use App\Models\Certificate;
use App\Repositories\BaseRepository;

class CertificateRepository extends BaseRepository
{
    public function __construct(Certificate $model)
    {
        parent::__construct($model);
    }
}
