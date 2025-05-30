<?php

namespace App\Services\Api;

use App\Services\BaseService;
use App\Repositories\Api\CommentRepository;
use App\Models\Reply;

class CommentService extends BaseService
{
    public function __construct(CommentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function addReply($comment, array $data)
    {
        return $comment->replies()->create([
            'content' => $data['content'],
            'replier_id' => $data['replier_id']
        ]);
    }

    public function findReply($replyId)
    {
        return Reply::find($replyId);
    }

    public function deleteReply($reply)
    {
        return $reply->delete();
    }
}