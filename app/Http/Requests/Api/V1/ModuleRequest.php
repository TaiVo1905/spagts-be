<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class ModuleRequest extends FormRequest
{
<<<<<<< HEAD
    public function authorize(): bool
=======
    public function authorize()
>>>>>>> dev
    {
        return true;
    }

<<<<<<< HEAD
    public function rules(): array
    {
        $rules = [
            'name' => ['sometimes', 'required', 'string', 'max:50'],
            'teacher_id' => ['sometimes', 'required', 'exists:users,id'],
        ];

        if ($this->isMethod('post')) {
            $rules['name'] = ['required', 'string', 'max:50'];
            $rules['teacher_id'] = ['required', 'exists:users,id'];
=======
    public function rules()
    {
        $method = $this->method();

        $rules = [
            'name' => 'string|max:50',
            'teacher_id' => 'exists:users,id',
        ];

        if ($method === 'POST') {
            $rules['name'] = 'required|string|max:50';
            $rules['teacher_id'] = 'required|exists:users,id';
        } else {
            foreach ($rules as $key => $value) {
                $rules[$key] = 'sometimes|' . $value;
            }
>>>>>>> dev
        }

        return $rules;
    }

<<<<<<< HEAD
    protected function prepareForValidation(): void
    {
        //
=======
    public function validated($key = null, $default = null)
    {
        $data = parent::validated();
        $result = [];

        if (isset($data['name'])) {
            $result['name'] = $data['name'];
        }
        if (isset($data['teacher_id'])) {
            $result['teacher_id'] = $data['teacher_id'];
        }

        return $result;
>>>>>>> dev
    }
}
