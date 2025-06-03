<?php

namespace App\Http\Filters\Api;

use App\Http\Filters\BaseFilter;

class WeeklyGoalFilter extends BaseFilter
{
    public function apply()
    {
        $this->whereEqual('student_id', $this->request->get('studentId'));
        $this->whereEqual('semester', $this->request->get('semester'));
        $this->whereLike('goal_content', $this->request->get('goal_content'));
        $this->whereEqual('is_completed', $this->request->get('is_completed'));
        $this->whereBetween('start_date', $this->request->get('start_date_from'), $this->request->get('start_date_to'));
        // $this->sort();
    }
}
