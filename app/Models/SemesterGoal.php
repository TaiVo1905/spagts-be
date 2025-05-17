<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Module;

class SemesterGoal extends Model
{
    protected $table = 'semester_goals';

    protected $fillable = [
        'modules_id',
        'student_id',
        'semester',
        'student_expected_course',
        'student_expected_teacher',
        'student_expected_themselves',
        'student_evaluation',
        'teacher_evaluation',
    ];

    public function module()
    {
        return $this->belongsTo(Module::class, 'modules_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
