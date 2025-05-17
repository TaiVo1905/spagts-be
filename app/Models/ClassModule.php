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
        return $this->belongsTo(ClassName::class, 'class_id');
    }

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }
}
