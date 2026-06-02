<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'number' => 'required|string|max:5',
            'ticket' => 'required|string|max:10',
            'client' => 'nullable|string|max:100',
            'system_id' => 'required|exists:systems,id',
            'title' => 'required|string|max:100',
            'version' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:100',
            'preconditions' => 'nullable|string|max:100',
            'steps' => 'nullable|string|max:100',
            'expected_result' => 'nullable|string|max:100',
            'actual_result' => 'nullable|string|max:100',
            'observations' => 'nullable|string|max:100',
            'tester_id' => 'required|exists:users,id',
            'developer_id' => 'required|exists:users,id',
            'created_by' => 'required|exists:users,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'type_id' => 'required|exists:types,id',
            'status_id' => 'required|exists:statuses,id',
        ];
    }
}
