<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class SemesterGoalResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'studentId' => $this->student_id,
            'moduleId' => $this->modules_id,
            'course' => $this->module->name,
            'semester' =>  $this->semester,
            'courseExpectation' => $this->student_expected_course,
            'teacherExpectation' => $this->student_expected_teacher,
            'selfExpectation' => $this->student_expected_themselves,
            'studentEvaluation' => $this->student_evaluation ?? '',
            'teacherEvaluation' => $this->teacher_evaluation ?? '',
        ];
    }
}
