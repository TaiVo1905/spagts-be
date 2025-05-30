<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'content' => 'required|string|max:1000',
        ];

        if ($this->isMethod('get')) {
            $rules = [
                'commentable_type' => 'required|string',
                'commentable_id' => 'required|integer',
                'field_name' => 'required|string',
                'row' => 'required|integer',
            ];
        }

        if ($this->isMethod('post') && $this->route('comment')) {
            $rules = [
                'content' => 'required|string|max:1000',
                'replier_id' => 'required|exists:users,id'
            ];
        }

        return $rules;
    }

    protected function prepareForValidation(): void
    {
        if($this->commentableType){
            $this->merge([
                'commentable_type' => $this->commentableType
            ]);
        }

        if($this->commentableId){
            $this->merge([
                'commentable_id' => $this->commentableId
            ]);
        }

        if($this->fieldName){
            $this->merge([
                'field_name' => $this->fieldName
            ]);
        }

        if($this->commenterId){
            $this->merge([
                'commenter_id' => $this->commenterId
            ]);
        }
    }
}