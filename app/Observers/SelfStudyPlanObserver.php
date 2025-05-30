<?php

namespace App\Observers;

use App\Models\SelfStudyPlan;
use App\Models\ActivityLog;


class SelfStudyPlanObserver
{
    /**
     * Handle the SelfStudyPlan "created" event.
     */
    public function created(SelfStudyPlan $selfStudyPlan): void
    {
        ActivityLog::create([
        'user_id' => auth()->id(),
        'action' => 'created',
        'table_name' => 'self_study_plan',
        'record_id' => $plan->id,
        'changes' => $plan->toArray(),
    ]);
    }

    /**
     * Handle the SelfStudyPlan "updated" event.
     */
    public function updated(SelfStudyPlan $plan)
    {
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'updated',
            'table_name' => 'self_study_plan',
            'record_id' => $plan->id,
            'changes' => $plan->getChanges(),
        ]);
    }


    /**
     * Handle the SelfStudyPlan "deleted" event.
     */
    public function deleted(SelfStudyPlan $selfStudyPlan): void
    {
        ActivityLog::create([
        'user_id' => auth()->id(),
        'action' => 'created',
        'table_name' => 'self_study_plan',
        'record_id' => $plan->id,
        'changes' => $plan->toArray(),
        ]);
    }

    /**
     * Handle the SelfStudyPlan "restored" event.
     */
    public function restored(SelfStudyPlan $selfStudyPlan): void
    {
        //
    }

    /**
     * Handle the SelfStudyPlan "force deleted" event.
     */
    public function forceDeleted(SelfStudyPlan $selfStudyPlan): void
    {
        //
    }
}
