<?php

namespace App\Repositories\Api\V1;

use App\Models\InClass;
use App\Repositories\BaseRepository;

class InClassRespository extends BaseRepository
{
    public function __construct(InClass $model)
    {
        parent::__construct($model);
    }


}
