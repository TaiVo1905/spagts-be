<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        // if ($this->isMethod('delete')) {
        //     return Auth::check() && Auth::user()->roles === 'Admin';
        // }
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
        } elseif ($this->isMethod('patch') && $this->routeIs('users.updatePassword')) {
            return [
                'current_password' => 'required|string',
                'new_password' => 'required|string|min:8|confirmed',
            ];
        }
        else {
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
