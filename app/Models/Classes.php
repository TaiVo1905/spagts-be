<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $table = 'classes';

    protected $fillable = ['teacher_id', 'name'];

    public function teacher() {
        return $this->belongsTo(User::class);
    }
    public function modules()
    {
        return $this->belongsToMany(Module::class, 'class_module', 'class_id', 'module_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_class', 'class_id', 'user_id');
    }

}
