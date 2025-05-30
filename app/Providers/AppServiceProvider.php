<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Models\SelfStudyPlan;
use App\Models\InClass;
use App\Observers\SelfStudyPlanObserver;
use App\Observers\InClassPlanObserver;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */

    public function boot()
    {
        Validator::extend('text', function ($attribute, $value, $parameters, $validator) {
        });
        SelfStudyPlan::observe(SelfStudyPlanObserver::class);
        InClass::observe(InClassPlanObserver::class);
    }
}
