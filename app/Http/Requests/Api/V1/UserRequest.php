<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
{
    $rules = [
        'name' => ['sometimes', 'string', 'max:255'],
        'imageUrl' => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        'email' => ['sometimes', 'email', 'max:255'],
        'current_password' => ['sometimes', 'string', 'min:8'],
        'password' => ['sometimes', 'string', 'min:8', 'confirmed'],
        'roles' => ['sometimes', 'string', 'in:Admin,Teacher,Student'],
    ];

    if ($this->isMethod('post') || $this->isMethod('put')) {
        $rules['name'][0] = 'required';
        $rules['email'][0] = 'required';
        $rules['password'][0] = 'required';
        $rules['roles'][0] = 'required';
    }

    return $rules;
}

protected function prepareForValidation()
{
    if ($this->hasFile('imageUrl')) {
        $this->merge([
            'image_url' => $this->file('imageUrl')
        ]);
    }
}

}
