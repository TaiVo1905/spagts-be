<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface
{
    public function all($params);
    public function find($id);
    public function create(array $data);
    public function update($model, array $data);
    public function delete($model);
}
