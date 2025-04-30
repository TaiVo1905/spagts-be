<?php

namespace App\Services\Api;

use App\Services\Api\Contracts\ServiceInterface;

class BaseService implements ServiceInterface
{
    protected $repository;

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
