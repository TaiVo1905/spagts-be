<?php

namespace App\Repositories\Api;

use App\Models\Comment; 
use App\Repositories\BaseRepository;

class CommentRepository extends BaseRepository
{
    public function __construct(Comment $model)
    {
        parent::__construct($model);
    }
}
