<?php

namespace App\Services\Api;
use App\Services\BaseService;
use App\Repositories\Api\ClassRepository;
use Illuminate\Support\Facades\DB;

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

        return $this->create($data);
    }

    public function getClassMembers($id)
    {
        $class = $this->repository->find($id);
        if (!$class) {
            throw new \Exception('Lớp học không tồn tại!');
        }

        $students = $class->users()
            ->where('roles', 'Student')
            ->get();
            
        $teachers = $class->users()
            ->where('roles', 'Teacher')
            ->get();

        return [
            'students' => $students,
            'teachers' => $teachers
        ];
    }

    public function updateClassMembers($id, array $data)
    {
        $class = $this->repository->find($id);
        if (!$class) {
            throw new \Exception('Lớp học không tồn tại!');
        }

        DB::beginTransaction();
        try {
            // Remove all existing members
            $class->users()->detach();
            
            // Add new members
            $allMemberIds = array_merge($data['student_ids'], $data['teacher_ids']);
            $class->users()->attach($allMemberIds);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
