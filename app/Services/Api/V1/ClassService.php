<?php

namespace App\Services\Api\V1;
use App\Services\Api\BaseService;
use App\Repositories\Api\V1\ClassRepository;


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
