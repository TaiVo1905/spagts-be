<?php

namespace App\Http\Requests\Api;
use Illuminate\Support\Facades\Log;


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
            'module' => ['sometimes', 'string', 'max:50'],
            'studentId' => ['sometimes', 'numeric'],
            'semester' => ['sometimes', 'numeric'],
            'date' => ['sometimes', 'date'],
            'description' => ['sometimes', 'string'],
        ];

        if ($this->isMethod('post') || $this->isMethod('put')) {
            $rules['imageUrl'][0] = 'required';
            $rules['module'][0] = 'required';
            $rules['studentId'][0] = 'required';
            $rules['semester'][0] = 'required';
            $rules['date'][0] = 'required';
            $rules['description'][0] = 'required';
        }

        Log::info($this->all());

        return $rules;
    }
}
