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
        if ($this->isMethod('post') || $this->isMethod('put')) {
            return [
                'name' => 'required|string|max:255',
                'imageUrl' => 'sometimes|string|max:255',
                'email' => 'required|email|max:255|unique:users,email',
                'password' => 'required|string|min:6|confirmed',
                'roles' => 'required|string|in:Admin,Teacher,Student',
            ];
        } else {
            return [
                'name' => 'sometimes|string|max:255',
                'imageUrl' => 'sometimes|string|max:255',
                'email' => 'sometimes|email|max:255|unique:users,email',
                'password' => 'sometimes|string|min:8|confirmed',
                'roles' => 'sometimes|string|in:Admin,Teacher,Student',
            ];
        }
    }

    public function prepareValidation() {
        if($this->imageUrl) {
            $this->merge([
                'image_url' => $this->imageUrl,
            ]);
        }
    }

}
