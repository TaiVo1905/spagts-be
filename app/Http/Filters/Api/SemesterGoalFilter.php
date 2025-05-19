<?php

namespace App\Http\Filters\Api;

use App\Http\Filters\Api\BaseFilter;

class SemesterGoalFilter extends BaseFilter
{
    public function apply()
    {
        $this->whereEqual('student_id', $this->request->user);
        $this->whereEqual('semester', $this->request->get('semester'));
    }
}
