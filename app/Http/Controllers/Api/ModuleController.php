<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Services\Api\ModuleService;
use App\Http\Resources\Api\ModuleResource;
use App\Http\Requests\Api\ModuleRequest;
use App\Http\Filters\Api\ModuleFilter;
use App\Models\Module;

class ModuleController extends BaseController
{
    public function __construct(ModuleService $service, ModuleRequest $request)
    {
        parent::__construct($service, ModuleResource::class, $request, ModuleFilter::class);
    }
}
