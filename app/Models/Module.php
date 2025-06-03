<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = ['name', 'teacher_id'];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
    public function classes()
    {
        return $this->belongsToMany(Classes::class, 'class_module', 'module_id', 'class_id');
    }

    public function classModule()
    {
        return $this->belongsToMany(classModule::class, 'class_id');

    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'class_module', 'module_id', 'class_id');
    }
}