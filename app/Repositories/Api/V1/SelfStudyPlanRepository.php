<?php

namespace App\Repositories\Api\V1;

use App\Models\SelfStudyPlan;
use App\Repositories\BaseRepository;

class SelfStudyPlanRepository extends BaseRepository
{
      public function __construct(SelfStudyPlan $model)
    {
        parent::__construct($model);
    }

// public function createSelfStudyPlan(array $data)
// {
//     return $this->create($data);  
// }

//      public function getAll()
//     {
//         return SelfStudyPlan::all();
//     }

//  public function update($id, array $data)
//     {
//         $model = $this->model->find($id);

//         if (!$model) {
//             throw new Exception("Không tìm thấy SelfStudyPlan với id = $id");
//         }

//         $model->fill($data);
//         $model->save();

//         return $model;
//     }
}


