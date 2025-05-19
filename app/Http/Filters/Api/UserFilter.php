<?php

namespace App\Http\Filters\Api;
use App\Http\Filters\Api\BaseFilter;

class UserFilter extends BaseFilter
{
    public function apply()
    {
        $this->whereLike('name', $this->request->name);
        $this->whereLike('email', $this->request->email);
        $this->whereEqual('roles', $this->request->roles);
        $this->sort();
    }
}
