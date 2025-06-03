<?php
namespace App\Services\Api;

use App\Repositories\Api\TimetableRepository;
use App\Services\BaseService;

class TimetableService extends BaseService
{
    public function __construct(TimetableRepository $repository)
    {
        $this->repository = $repository;
    }
}