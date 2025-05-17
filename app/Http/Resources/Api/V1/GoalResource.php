<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class GoalResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'userId' => $this->student_id,
            'moduleId' => $this->modules_id,
            'semester' => 'S' . $this->semester,
            'course' => $this->student_expected_course,
            'courseExpectation' => $this->student_expected_course,
            'teacherExpectation' => $this->student_expected_teacher,
            'selfExpectation' => $this->student_expected_themselves,
            'studentEvaluation' => $this->student_evaluation ?? '',
            'teacherEvaluation' => $this->teacher_evaluation ?? '',
        ];
    }
}
