<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SelfStudyPlan extends Model
{
    protected $table = 'self_study_plan';

    protected $fillable = [
        'date',
        'lesson_learned',
        'time_allocation',
        'learning_resources',
        'learning_activities',
        'concentration',
        'follow_plan_reflection',
        'evaluation',
        'reinforcing_techniques',
        'note',
        'module_id',
        'student_id',
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
