<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Module;

class ClassModule extends Model
{
    protected $table = 'class_module';

    protected $fillable = ['class_id', 'module_id'];

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }

    public function modules()
    {
        return $this->belongsToMany(Module::class, 'class_module');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'user_class');
    }
}
