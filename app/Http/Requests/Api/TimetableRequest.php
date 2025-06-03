<?php
namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class TimetableRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        $method = $this->method();
        
        // Common rules for all methods
        $baseRules = [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'all_day' => 'required|boolean',
            'color' => 'nullable|string|max:50',
            'user_id' => 'required|numeric|exists:users,id',
        ];

        switch (strtoupper($method)) {
            case 'POST':
                return array_merge($baseRules, [
                    'start' => 'required|date',
                    'end' => 'required|date|after_or_equal:start',
                ]);

            case 'PUT':
            case 'PATCH':
                return array_merge($baseRules, [
                    'start' => 'required|date',
                    'end' => 'required|date|after_or_equal:start',
                ]);

            case 'GET':
            case 'DELETE':
            default:
                return [];
        }
    }

    /**
     * Custom validation messages.
     */
    public function messages()
    {
        return [
            'title.required' => 'The title field is required.',
            'title.max' => 'Title may not be longer than 255 characters.',
            'start.required' => 'Start time is required.',
            'start.date' => 'Start time must be a valid date.',
            'end.required' => 'End time is required.',
            'end.date' => 'End time must be a valid date.',
            'end.after_or_equal' => 'End time must be after or equal to start time.',
            'all_day.required' => 'The all day field is required.',
            'all_day.boolean' => 'The all day field must be true or false.',
            'user_id.required' => 'User ID is required.',
            'user_id.exists' => 'The specified user does not exist.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        // Convert string booleans to actual booleans
        if ($this->has('all_day')) {
            $this->merge([
                'all_day' => filter_var($this->all_day, FILTER_VALIDATE_BOOLEAN),
            ]);
        }

        // Format dates if needed
        if ($this->has('start')) {
            $this->merge(['start' => Carbon::parse($this->start)->format('Y-m-d H:i:s')]);
        }
        
        if ($this->has('end')) {
            $this->merge(['end' => Carbon::parse($this->end)->format('Y-m-d H:i:s')]);
        }
    }
}