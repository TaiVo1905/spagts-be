<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Services\Api\V1\CertificateService;
use App\Http\Resources\Api\V1\CertificateResources;
use App\Http\Requests\Api\V1\CertificateRequest;
use App\Http\Filters\Api\V1\CertificateFilter;
// use App\Models\Certificate;

class CertificateController extends BaseController
{
    public function __construct(CertificateService $service, CertificateRequest $request)
    {
        parent::__construct($service, CertificateResources::class, $request, CertificateFilter::class);
    }
}
