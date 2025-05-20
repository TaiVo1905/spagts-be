<?php

namespace App\Services;

use App\Services\Api\Contracts\ServiceInterface;
use Illuminate\Support\Facades\Log;

class BaseService implements ServiceInterface
{
    protected $repository;
    protected $cloudService;

    public function list($filter)
    {
        return $this->repository->all($filter);
    }

    public function find($id)
    {
        return $this->repository->find($id);
    }

    public function create(array $data)
    {
        Log::info("Service:", $data);
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
