<?php

namespace App\Http\Filters\Api;

use App\Http\Filters\Api\BaseFilter;

class CertificateFilter extends BaseFilter
{
    public function apply()
    {
        $this->whereEqual('student_id', $this->request->student_id);
        $this->whereLike('module', $this->request->module);
        $this->whereLike('date', $this->request->date);
        $this->whereEqual('description', $this->request->description);
        $this->whereEqual('semester', $this->request->semester);
        $this->sort();
    }
}
