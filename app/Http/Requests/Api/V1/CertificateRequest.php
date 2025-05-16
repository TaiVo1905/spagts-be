<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class CertificateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'imageUrl' => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'module' => ['sometimes', 'email', 'max:50'],
            'date' => ['sometimes', 'date'],
            'description' => ['sometimes', 'string'],
        ];

        if ($this->isMethod('post') || $this->isMethod('put')) {
            $rules['imageUrl'][0] = 'required';
            $rules['module'][0] = 'required';
            $rules['date'][0] = 'required';
            $rules['description'][0] = 'required';
        }

        return $rules;
    }
}
