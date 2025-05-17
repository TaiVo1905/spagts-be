<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeekGoal extends Model
{
    protected $table = 'weekly_goals';  // khai báo tên bảng đúng như trong DB


    protected $fillable = [
        'start_date',
        'end_date',
        'goal_content',
        'is_completed',
        'user_id',
    ];

    // Quan hệ với User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}