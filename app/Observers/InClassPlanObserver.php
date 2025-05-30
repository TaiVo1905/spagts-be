<?php

namespace App\Observers;

use App\Models\InClass;
use App\Models\ActivityLog;

class InClassPlanObserver
{
    /**
     * Handle the InClassPlan "created" event.
     */
    public function created(InClass $plan): void
    {
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'updated',
            'table_name' => 'in_class_plan',
            'record_id' => $plan->id,
            'changes' => $plan->toArray(),
        ]);
    }

    /**
     * Handle the InClassPlan "updated" event.
     */
    public function updated(InClassPlan $plan)
    {
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'updated',
            'table_name' => 'in_class_plan',
            'record_id' => $plan->id,
            'changes' => $plan->getChanges(),
        ]);
    }


    /**
     * Handle the InClassPlan "deleted" event.
     */
    public function deleted(InClassPlan $plan): void
    {
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'updated',
            'table_name' => 'in_class_plan',
            'record_id' => $plan->id,
            'changes' => $plan->toArray(),
        ]);
    }

    /**
     * Handle the InClassPlan "restored" event.
     */
    public function restored(InClassPlan $plan): void
    {
        //
    }

    /**
     * Handle the InClassPlan "force deleted" event.
     */
    public function forceDeleted(InClassPlan $plan): void
    {
        //
    }
}
