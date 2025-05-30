<?php

namespace App\Http\Filters\Api;

use App\Http\Filters\BaseFilter;

class SemesterGoalFilter extends BaseFilter
{
    public function apply()
    {
        $this->whereEqual('student_id', $this->request->studentId);
        $this->whereEqual('semester', $this->request->get('semester'));
    }
}
