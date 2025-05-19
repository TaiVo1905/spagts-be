<?php
namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Services\Api\SelfStudyPlanService;
use App\Http\Resources\Api\SelfStudyPlanResources;
use App\Http\Requests\Api\SelfStudyPlanRequest;
use App\Http\Filters\Api\SelfStudyPlanFilter;
use App\Models\SelfStudyPlan;  

class SelfStudyPlanController extends BaseController
{
     public function __construct(SelfStudyPlanService $service, SelfStudyPlanRequest $request)
    {
        parent::__construct($service, SelfStudyPlanResources::class, $request, SelfStudyPlanFilter::class);
    }
}



// public function store(Request $request)
// {
//     $newPlan = $this->service->create($request->all());
//     return new SelfStudyPlanResources($newPlan);
// }

// public function show($id)
// {
//     $plan = SelfStudyPlan::find($id);
//     if (!$plan) {
//         return response()->json(['message' => 'Not Found'], 404);
//     }
//     return response()->json($plan);
// }

//     public function index()
//     {
//         $plans = $this->service->getAll();
//         return SelfStudyPlanResources::collection($plans);
//     }

//      public function update(Request $request, $id)
//     {
//         $updatedPlan = $this->service->update($id, $request->all());
//         return new SelfStudyPlanResources($updatedPlan);
//     }

