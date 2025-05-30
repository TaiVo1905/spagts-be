<?php

namespace App\Http\Filters\Api;

use Illuminate\Database\Eloquent\Builder;
use App\Http\Filters\BaseFilter;


class ModuleFilter extends BaseFilter
{
    public function apply()
    {
        $this->whereLike('name', $this->request->name);
        $this->whereEqual('user_id', $this->request->user_id);
        $this->sort();
    }
}
