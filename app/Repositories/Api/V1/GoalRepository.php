<?php

namespace App\Repositories\Api\V1;

use App\Repositories\BaseRepository;
use App\Models\SemesterGoal;

class GoalRepository extends BaseRepository
{
    public function __construct(SemesterGoal $model)
    {
        parent::__construct($model);
    }

    public function all($filter = null, $studentId = null)
    {
        $query = $this->model->query();
        if ($studentId) {
            $query->where('student_id', $studentId);
        }
        if (is_string($filter) && class_exists($filter)) {
            $filter = new $filter($query, request());
            $filter->apply();
        }
        return $query->paginate(request('limit', 10));
    }

    public function find($id, $studentId = null)
    {
        $query = $this->model->query();
        if ($studentId) {
            $query->where('student_id', $studentId);
        }
        return $query->findOrFail($id);
    }
}
