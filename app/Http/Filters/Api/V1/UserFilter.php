<?php

namespace App\Http\Filters\Api\V1;
use App\Filters\BaseFilter;
use App\Http\Filters\BaseFilter as FiltersBaseFilter;
use Faker\Provider\Base;

class UserFilter extends FiltersBaseFilter
{
    public function apply()
    {
        $this->whereLike('name', $this->request->name);
        $this->whereLike('email', $this->request->email);
        $this->whereEqual('roles', $this->request->roles);
        $this->sort();
    }
}
