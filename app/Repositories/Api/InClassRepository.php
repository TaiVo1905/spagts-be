<?php

namespace App\Repositories\Api;

use App\Models\InClass;
use App\Repositories\BaseRepository;

class InClassRepository extends BaseRepository
{
    public function __construct(InClass $model)
    {
        parent::__construct($model);
    }


}
