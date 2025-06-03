<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start',
        'end',
        'all_day',
        'color',
        'user_id',
        'module_id',
        'plan_id',
        'type',
        'semester'
    ];

    protected $casts = [
        'start' => 'datetime:Y-m-d H:i:s',
        'end' => 'datetime:Y-m-d H:i:s',
        'all_day' => 'boolean',
        'module_id' => 'integer',
        'plan_id' => 'integer',
        'semester' => 'integer'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function inClassPlan()
    {
        return $this->belongsTo(InClassPlan::class, 'plan_id');
    }

    public function selfStudyPlan()
    {
        return $this->belongsTo(SelfStudyPlan::class, 'plan_id');
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'start' => $this->start->toIso8601String(),
            'end' => $this->end->toIso8601String(),
            'allDay' => $this->all_day,
            'color' => $this->color,
            'user_id' => $this->user_id,
            'module_id' => $this->module_id,
            'plan_id' => $this->plan_id,
            'type' => $this->type,
            'semester' => $this->semester,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}