<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comment extends Model
{
    protected $fillable = [
        'commentable_type',
        'commentable_id',
        'field_name',
        'row',
        'commenter_id',
        'content'
    ];

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function commenter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'commenter_id');
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Reply::class);
    }
}