<?php
namespace App\Services\Api\V1;

use App\Repositories\Api\V1\TimetableRepository;
use App\Services\Api\BaseService;

class TimetableService extends BaseService
{
    public function __construct(TimetableRepository $repository)
    {
        $this->repository = $repository;
    }
}