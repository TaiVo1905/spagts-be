<?php

namespace App\Services\Api\Contracts;

interface ServiceInterface
{
    public function list($params);
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
