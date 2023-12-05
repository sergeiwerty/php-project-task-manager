<?php

namespace App\Http\Requests\TaskStatusRequests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskStatusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:50|unique:App\Models\TaskStatus',
        ];
    }

    /**
     * Get the customized validation messages for task status update request
     *
     * @return array[]
     */
    public function messages(): array
    {
        return [
            [
                'name.required' => __('validation.Field is required'),
                'name.max:50' => __('validation.Exceeded maximum name length of :max characters'),
                'name.unique' => __('validation.The task name has already been taken'),
            ]
        ];
    }
}
