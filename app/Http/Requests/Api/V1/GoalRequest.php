<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class GoalRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $method = $this->method();

        $rules = [
            'student_id' => 'required',
            'semester' => 'string|in:S1,S2,S3,S4,S5,S6',
            'modules_id' => 'exists:modules,id',
            'course' => 'string|max:255',
            'courseExpectation' => 'string',
            'teacherExpectation' => 'string',
            'selfExpectation' => 'string',
            'studentEvaluation' => 'nullable|string',
            'teacherEvaluation' => 'nullable|string',
        ];

        if ($method === 'POST') {
            $rules['student_id'] = 'required';
            $rules['semester'] = 'required|string|in:S1,S2,S3,S4,S5,S6';
            $rules['modules_id'] = 'required|exists:modules,id';
            $rules['course'] = 'required|string|max:255';
            $rules['courseExpectation'] = 'required|string';
            $rules['teacherExpectation'] = 'required|string';
            $rules['selfExpectation'] = 'required|string';
        } else {
            foreach ($rules as $key => $value) {
                $rules[$key] = 'sometimes|' . $value;
            }
        }

        return $rules;
    }

    // public function validated($key = null, $default = null)
    // {
    //     $data = parent::validated();
    //     $result = [];

    //     if (isset($data['semester'])) {
    //         $result['semester'] = str_replace('S', '', $data['semester']);
    //     }
    //     if (isset($data['modules_id'])) {
    //         $result['modules_id'] = $data['modules_id'];
    //     }
    //     if (isset($data['course'])) {
    //         $result['student_expected_course'] = $data['course'];
    //     }
    //     if (isset($data['courseExpectation'])) {
    //         $result['student_expected_course'] = $data['courseExpectation'];
    //     }
    //     if (isset($data['teacherExpectation'])) {
    //         $result['student_expected_teacher'] = $data['teacherExpectation'];
    //     }
    //     if (isset($data['selfExpectation'])) {
    //         $result['student_expected_themselves'] = $data['selfExpectation'];
    //     }
    //     if (isset($data['studentEvaluation'])) {
    //         $result['student_evaluation'] = $data['studentEvaluation'];
    //     }
    //     if (isset($data['teacherEvaluation'])) {
    //         $result['teacher_evaluation'] = $data['teacherEvaluation'];
    //     }

    //     return $result;
    // }
}
