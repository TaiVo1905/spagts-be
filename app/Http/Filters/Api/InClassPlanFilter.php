<?php

namespace App\Http\Filters\Api;

use App\Http\Filters\BaseFilter;

class InClassPlanFilter extends BaseFilter
{
    public function apply()
    {
        $startDate = $this->request->get('start_date');
        $endDate = $this->request->get('end_date');
        if ($startDate && $endDate) {
            $this->query->whereBetween('date', [$startDate, $endDate]);
        } elseif ($startDate) {
            $this->whereDate('date', '>=', $startDate);
        } elseif ($endDate) {
            $this->whereDate('date', '<=', $endDate);
        }

        $this->whereEqual('student_id', $this->request->get('studentId'));

        $this->whereEqual('module_id', $this->request->get('module_id'));

        $this->whereLike('lesson_learned', $this->request->get('lesson_learned'));

        if ($this->request->has('self_assessment_min')) {
            $this->query->where('self_assessment', '>=', $this->request->get('self_assessment_min'));
        }
        if ($this->request->has('self_assessment_max')) {
            $this->query->where('self_assessment', '<=', $this->request->get('self_assessment_max'));
        }

        if (!is_null($this->request->get('problem_solved'))) {
            $this->whereEqual('problem_solved', filter_var($this->request->get('problem_solved'), FILTER_VALIDATE_BOOLEAN));
        }

        $this->sort();

        return $this->query;
    }
}
