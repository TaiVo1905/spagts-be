<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeeklyGoal extends Model
{
    protected $table = 'weekly_goals';


    protected $fillable = [
        'start_date',
        'end_date',
        'goal_content',
        'is_completed',
        'student_id',
    ];
}