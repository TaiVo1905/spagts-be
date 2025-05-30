<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name',
        'image_key',
        'email',
        'password',
        'roles'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function class() {
        return $this->hasOne(Classes::class, 'teacher_id');
    }

    public function classUsers() {
    return $this->hasMany(UserClass::class);
    }

    public function classes() {
        return $this->belongsToMany(Classes::class, 'user_class','user_id', 'class_id');
    }

    public function modules()
    {
        return Module::whereHas('classes', function ($query) {
            $query->whereHas('users', function ($q) {
                $q->where('users.id', $this->id);
            });
        });
    }

}