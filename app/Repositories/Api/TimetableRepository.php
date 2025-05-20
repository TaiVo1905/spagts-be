<?php
namespace App\Repositories\Api;

use App\Models\Timetable;
use App\Repositories\BaseRepository;

class TimetableRepository extends BaseRepository
{
    public function __construct(Timetable $model)
    {
        parent::__construct($model);
    }
}