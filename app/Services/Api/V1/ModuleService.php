<?php

namespace App\Services\Api\V1;

use App\Repositories\Api\V1\ModuleRepository;
use App\Services\Api\BaseService;

class ModuleService extends BaseService
{
    public function __construct(ModuleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function all($studentId = null)
    {
        return $this->repository->all(null, $studentId);
    }

    public function find($id, $studentId = null)
    {
        return $this->repository->find($id, $studentId);
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update($model, array $data)
    {
        return $this->repository->update($model, $data);
    }

    public function delete($model)
    {
        return $this->repository->delete($model);
    }
}