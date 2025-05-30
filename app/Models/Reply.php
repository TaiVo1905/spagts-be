<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reply extends Model
{
    protected $fillable = [
        'comment_id',
        'replier_id',
        'content'
    ];

    public function comment(): BelongsTo
    {
        return $this->belongsTo(Comment::class);
    }

    public function replier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'replier_id');
    }
}