<?php
namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Services\Api\WeeklyGoalService;
use App\Http\Resources\Api\WeeklyGoalResource;
use App\Http\Requests\Api\WeeklyGoalRequest;
use App\Http\Filters\Api\WeeklyGoalFilter;
use App\Models\WeekGoal; 
use App\Http\Controllers\BaseController;


class WeeklyGoalController extends BaseController
{
     public function __construct(WeeklyGoalService $service, WeeklyGoalRequest $request)
    {
        parent::__construct($service, WeeklyGoalResource::class, $request, WeeklyGoalFilter::class);
    }
}