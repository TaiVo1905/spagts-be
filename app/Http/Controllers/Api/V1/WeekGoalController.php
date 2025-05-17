<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\BaseController;
use Illuminate\Http\Request;
use App\Services\Api\V1\WeekGoalService;
use App\Http\Resources\Api\V1\WeekGoalResource;
use App\Http\Requests\Api\V1\WeekGoalRequest;
use App\Http\Filters\Api\V1\WeekGoalFilter;
use App\Models\WeekGoal;  

class WeekGoalController extends BaseController
{
     public function __construct(WeekGoalService $service, WeekGoalRequest $request)
    {
        parent::__construct($service, WeekGoalResource::class, $request, WeekGoalFilter::class);
    }
    public function getAll()
{
    // Lấy hết dữ liệu WeekGoal
    $goals = WeekGoal::all();

    // Trả về collection dưới dạng resource
    return WeekGoalResource::collection($goals);
}

}