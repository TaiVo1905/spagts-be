<?php

namespace App\Http\Filters\Api;
use App\Http\Filters\Api\BaseFilter;

class ClassFilter extends BaseFilter
{
    public function apply()
    {
        $this->whereLike('name', $this->request->name);
        $this->sort();
    }
}
