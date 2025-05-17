<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InClass extends Model
{

    protected $table = 'in_class_plan';

    protected $fillable = [
        'date',
        'lesson_learned',
        'self_assessment',
        'difficulties',
        'plan_to_improve',
        'problem_solved',
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
