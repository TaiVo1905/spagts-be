<?php

namespace App\Http\Filters\Api;
use App\Http\Filters\BaseFilter;

class TimetableFilter extends BaseFilter
{
    public function apply()
    {
        $this->whereEqual('user_id', $this->request->user_id);
        $this->sort();
    }
}
