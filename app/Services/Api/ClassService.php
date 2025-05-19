<?php

namespace App\Services\Api;
use App\Services\BaseService;
use App\Repositories\Api\ClassRepository;


class ClassService extends BaseService
{
    public function __construct(ClassRepository $classRepository)
    {
        $this->repository = $classRepository;
    }

    public function createClass(array $data)
    {
        $existingClass = $this->repository->findByName($data['name']);

        if ($existingClass) {
            throw new \Exception('Lớp học đã tồn tại!');
        }

        return $this->create($data);}

   
}
