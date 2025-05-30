<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Filters\Api\CommentFilter;
use App\Http\Requests\Api\CommentRequest;
use App\Http\Resources\Api\CommentResource;
use App\Http\Resources\Api\ReplyResource;
use App\Services\Api\CommentService;

class CommentController extends BaseController
{
    public function __construct(
        CommentService $service,
        CommentRequest $request
    ) {
        parent::__construct(
            $service,
            CommentResource::class,
            $request,
            CommentFilter::class
        );
    }

    /**
     * Get comments for specific entity
     */
    // public function getEntityComments()
    // {
    //     $comments = $this->service->getEntityComments(
    //         $this->request->commentable_type,
    //         $this->request->commentable_id,
    //         $this->request->field_name,
    //         $this->request->row,
    //         $this->filter
    //     );

    //     return $this->successResponse(
    //         CommentResource::collection($comments)
    //     );
    // }


    public function addReply($commentId)
    {
        $comment = $this->service->find($commentId);
        $reply = $this->service->addReply($comment, $this->request->all());

        return $this->successResponse(
            new ReplyResource($reply),
            'Reply added successfully',
            201
        );
    }

    public function deleteReply($replyId)
    {
        try {
            $reply = $this->service->findReply($replyId);
            if (!$reply) {
                return $this->errorResponse('Reply not found');
            }
            
            $this->service->deleteReply($reply);
            return $this->successResponse(null, 'Reply deleted successfully');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }
}