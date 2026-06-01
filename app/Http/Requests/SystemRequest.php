<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SystemRequest extends FormRequest
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
            'name' => ['required', 'min:3', 'max:30'],
            'code' => ['nullable', 'min:3', 'max:10'],
            'description' => ['required', 'min:3', 'max:255'],
            'active' => ['required', 'boolean'],
            'company_id' => ['required', 'exists:companies,id'],
            'system_status_id' => ['required', 'exists:system_statuses,id'],
        ];
    }
}
