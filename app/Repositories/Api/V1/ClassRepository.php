<?php

namespace App\Repositories\Api\V1;

use App\Models\ClassName; 
use App\Repositories\BaseRepository;

class ClassRepository extends BaseRepository
{
    public function __construct(ClassName $model)
    {
        parent::__construct($model);
    }
}
