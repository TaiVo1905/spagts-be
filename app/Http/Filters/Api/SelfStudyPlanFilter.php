<?php

namespace App\Http\Filters\Api;

use App\Http\Filters\BaseFilter;

class SelfStudyPlanFilter extends BaseFilter
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
        $this->whereEqual('semester', $this->request->get('semester'));

        $this->whereEqual('module_id', $this->request->get('module_id'));

        $this->whereLike('lesson_learned', $this->request->get('lesson_learned'));

        if ($this->request->has('concentration_min')) {
            $this->query->where('concentration', '>=', $this->request->get('concentration_min'));
        }
        if ($this->request->has('concentration_max')) {
            $this->query->where('concentration', '<=', $this->request->get('concentration_max'));
        }

        $this->sort();

        return $this->query;
    }
}
