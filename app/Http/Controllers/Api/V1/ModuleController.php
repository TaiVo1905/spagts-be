<?php
namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Api\V1\ModuleService;
use App\Http\Resources\Api\V1\ModuleResource;
use App\Http\Requests\Api\V1\ModuleRequest;
use App\Http\Filters\Api\V1\ModuleFilter;
use App\Models\Module;

class ModuleController extends BaseController
{
    public function __construct(ModuleService $service, ModuleRequest $request)
    {
        parent::__construct($service, ModuleResource::class, $request, ModuleFilter::class);
    }
}
