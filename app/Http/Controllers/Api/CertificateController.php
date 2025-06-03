<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Services\Api\CertificateService;
use App\Http\Resources\Api\CertificateResources;
use App\Http\Requests\Api\CertificateRequest;
use App\Http\Filters\Api\CertificateFilter;
// use App\Models\Certificate;

class CertificateController extends BaseController
{
    public function __construct(CertificateService $service, CertificateRequest $request)
    {
        parent::__construct($service, CertificateResources::class, $request, CertificateFilter::class);
    }
}
