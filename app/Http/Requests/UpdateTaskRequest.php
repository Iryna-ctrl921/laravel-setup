<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        'status' => ['sometimes', 'string'],
        'project_id' => ['sometimes', 'integer', 'exists:projects,id'],
        'author_id' => ['sometimes', 'integer'],
        'assigned_to' => ['nullable', 'integer'],
        'due_date' => ['nullable', 'date'],
        ];
    }
}
