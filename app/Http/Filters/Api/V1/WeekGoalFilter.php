<?php

namespace App\Http\Filters\Api\V1;

use App\Http\Filters\BaseFilter;

class WeekGoalFilter extends BaseFilter
{
    /**
     * Áp dụng bộ lọc lên query dựa trên request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply()
    {
        // Lọc theo nội dung mục tiêu (goal_content) nếu có
        if ($this->request->has('goal_content')) {
            $this->whereLike('goal_content', $this->request->get('goal_content'));
        }

        // Lọc theo trạng thái hoàn thành (is_completed) nếu có
        if ($this->request->has('is_completed')) {
            $this->whereEqual('is_completed', $this->request->get('is_completed'));
        }

        // Lọc theo khoảng thời gian bắt đầu (start_date)
        if ($this->request->has('start_date_from') && $this->request->has('start_date_to')) {
            $this->whereBetween('start_date', $this->request->get('start_date_from'), $this->request->get('start_date_to'));
        }

        // Sắp xếp theo tham số gửi lên, mặc định theo id giảm dần
        $this->sort();

        // Trả về query đã được filter
        return $this->query;
    }
}
