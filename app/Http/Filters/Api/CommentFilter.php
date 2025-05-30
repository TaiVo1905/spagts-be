<?php

namespace App\Http\Filters\Api;

use Illuminate\Database\Eloquent\Builder;
use App\Http\Filters\BaseFilter;


class CommentFilter extends BaseFilter
{
    public function apply()
    {
        // Filter by commentable type
        $this->whereEqual('commentable_type', $this->request->commentable_type);

        // Filter by commentable ID
        $this->whereEqual('commentable_id', $this->request->commentable_id);

        // Filter by field name
        $this->whereEqual('field_name', $this->request->field_name);

        // Filter by row number
        $this->whereEqual('row', $this->request->row);

        // Filter by commenter ID
        if ($this->request->has('commenter_id')) {
            $this->whereEqual('commenter_id', $this->request->commenter_id);
        }

        // Search in content
        if ($this->request->has('search')) {
            $this->whereLike('content', $this->request->search);
        }

        // Date range filtering
        if ($this->request->has('start_date') && $this->request->has('end_date')) {
            $this->whereBetween('created_at', $this->request->start_date, $this->request->end_date);
        } elseif ($this->request->has('start_date')) {
            $this->whereDate('created_at', '>=', $this->request->start_date);
        } elseif ($this->request->has('end_date')) {
            $this->whereDate('created_at', '<=', $this->request->end_date);
        }

        // Sort results
        $this->sort();

        return $this->query;
    }

    /**
     * Special filter to only include comments with replies
     */
    public function withReplies()
    {
        $this->query->has('replies');
        return $this;
    }

    /**
     * Filter by specific reply author
     */
    // public function repliedBy($userId)
    // {
    //     $this->query->whereHas('replies', function (Builder $query) use ($userId) {
    //         $query->where('replier_id', $userId);
    //     });
    //     return $this;
    // }
}