<?php

namespace App\Http\Filters\Api\V1;

use App\Http\Filters\BaseFilter;

class CertificateFilter extends BaseFilter
{
    public function apply()
    {
        $this->whereLike('module', $this->request->module);
        $this->whereLike('date', $this->request->date);
        $this->whereEqual('description', $this->request->description);
        $this->sort();
    }
}
