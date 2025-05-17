<?php

namespace App\Http\Filters\Api\V1;

use Illuminate\Database\Eloquent\Builder;
use App\Http\Filters\BaseFilter;


class ModuleFilter extends BaseFilter
{
    public function apply()
    {
        $this->whereLike('name', $this->request->name);
        $this->sort();
    }
}
