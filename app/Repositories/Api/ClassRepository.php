<?php

namespace App\Repositories\Api;

use App\Models\Classes; 
use App\Repositories\BaseRepository;

class ClassRepository extends BaseRepository
{
    public function __construct(Classes $model)
    {
        parent::__construct($model);
    }
}
