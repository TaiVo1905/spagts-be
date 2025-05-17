<?php

namespace App\Services\Api\V1;

use App\Repositories\Api\V1\GoalRepository;
use App\Services\Api\BaseService;
use Illuminate\Support\Facades\DB;

class GoalService extends BaseService
{
    public function __construct(GoalRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(array $data)
    {
        if ($data['student_id'] === null) {
            throw new \Exception('Student ID is required.', 400);
        }

        $moduleId = $data['modules_id'];

        $hasAccess = DB::table('user_class')
            ->join('class_module', 'user_class.class_id', '=', 'class_module.class_id')
            ->where('user_class.user_id', $data['student_id'])
            ->where('class_module.module_id', $moduleId)
            ->exists();

        if (!$hasAccess) {
            throw new \Exception('You do not have access to this module.', 403);
        }

        $data['semester'] = str_replace('S', '', $data['semester']);
        $data['student_id'] = $data['student_id'];
        $data['student_evaluation'] = $data['student_evaluation'] ?? '';
        $data['teacher_evaluation'] = $data['teacher_evaluation'] ?? '';
        return parent::create($data);
    }

    public function update($model, array $data)
    {
        if ($data['student_id'] === null) {
            throw new \Exception('Student ID is required.', 400);
        }

        if (isset($data['modules_id'])) {
            $moduleId = $data['modules_id'];

            $hasAccess = DB::table('user_class')
                ->join('class_module', 'user_class.class_id', '=', 'class_module.class_id')
                ->where('user_class.user_id', $data['student_id'])
                ->where('class_module.module_id', $moduleId)
                ->exists();

            if (!$hasAccess) {
                throw new \Exception('You do not have access to this module.', 403);
            }
        }

        if (isset($data['semester'])) {
            $data['semester'] = str_replace('S', '', $data['semester']);
        }
        return parent::update($model, $data);
    }
}
