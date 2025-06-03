<?php

namespace App\Http\Filters\Api;
use App\Http\Filters\BaseFilter;

class UserFilter extends BaseFilter
{
    public function apply()
    {
        $this->whereLike('name', $this->request->name);
        $this->whereLike('email', $this->request->email);
        $this->whereEqual('roles', $this->request->roles);
        // $this->sort();
        // if ($this->request->has('moduleId')) {
        //     $this->filterByModuleId($this->request->get('moduleId'));
        // }

        return $this->query;
    }

    // protected function filterByModuleId($moduleId)
    // {
    //     if (!empty($moduleId)) {
    //         $this->query->whereHas('classes', function ($query) use ($moduleId) {
    //             $query->whereHas('modules', function ($q) use ($moduleId) {
    //                 $q->where('modules.id', $moduleId);
    //             });
    //         });
    //     }
    // }
}
