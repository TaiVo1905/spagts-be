<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class SemesterGoalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules():array
    {
        return [
            'studentId' => 'sometimes|integer|exists:users,id',
            'semester' => 'sometimes|numeric|in:1,2,3,4,5,6',
            'moduleId' => 'exists:modules,id',
            'courseExpectation' => 'sometimes|string',
            'teacherExpectation' => 'sometimes|string',
            'selfExpectation' => 'sometimes|string',
            'studentEvaluation' => 'nullable|string',
            'teacherEvaluation' => 'nullable|string',
        ];

        if ($this->isMethod('POST')) {
            return [
                'studentId' => 'required|integer|exists:users,id',
                'semester' => 'required|numeric|in:1,2,3,4,5,6',
                'moduleId' => 'required|exists:modules,id',
                'courseExpectation' => 'required|string',
                'teacherExpectation' => 'required|string',
                'selfExpectation' => 'required|string',
            ];
        };
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation():void
    {
        if($this->studentId){
            $this->merge([
                'student_id' => $this->studentId
            ]);

        }

        if($this->moduleId){
            $this->merge([
                'modules_id' => $this->moduleId
            ]);

        }

        if($this->courseExpectation){
            $this->merge([
                'student_expected_course' => $this->courseExpectation,
            ]);
        }

        if($this->teacherExpectation){
            $this->merge([
                'student_expected_teacher' => $this->teacherExpectation,
            ]);
        }

        if($this->selfExpectation){
            $this->merge([
                'student_expected_themselves' => $this->selfExpectation,
            ]);
        }

        if($this->studentEvaluation){
            $this->merge([
                'student_evaluation' => $this->studentEvaluation,
            ]);
        }

        if($this->teacherEvaluation){
            $this->merge([
                'teacher_evaluation' => $this->teacherEvaluation,
            ]);
        }
    }
}