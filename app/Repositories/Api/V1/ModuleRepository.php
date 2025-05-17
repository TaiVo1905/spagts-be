<?php

namespace App\Repositories\Api\V1;

use App\Repositories\BaseRepository;
use App\Models\Module;
use Illuminate\Support\Facades\DB;

class ModuleRepository extends BaseRepository
{
    public function __construct(Module $model)
    {
        parent::__construct($model);
    }

    public function all($filter = null, $studentId = null)
    {
        $query = $this->model->query();

        if ($studentId) {
            $query->whereExists(function ($subquery) use ($studentId) {
                $subquery->select(DB::raw(1))
                    ->from('class_module')
                    ->join('user_class', 'class_module.class_id', '=', 'user_class.class_id')
                    ->whereColumn('class_module.module_id', 'modules.id')
                    ->where('user_class.user_id', $studentId);
            });
        }

        if ($filter) {
            $filter = new $filter($query, request());
            $filter->apply();
        }

        return $query->paginate(request('limit', 10));
    }

    public function find($id, $studentId = null)
    {
        $query = $this->model->query();

        if ($studentId) {
            $query->whereExists(function ($subquery) use ($studentId) {
                $subquery->select(DB::raw(1))
                    ->from('class_module')
                    ->join('user_class', 'class_module.class_id', '=', 'user_class.class_id')
                    ->whereColumn('class_module.module_id', 'modules.id')
                    ->where('user_class.user_id', $studentId);
            });
        }

        return $query->findOrFail($id);
    }
}
