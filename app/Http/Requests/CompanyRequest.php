<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyRequest extends FormRequest
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
            'name' => ['required', 'min:3', 'max:100'],
            'document' => ['required', 'min:11', 'max:14', Rule::unique('companies', 'document')->ignore($this->company)],
            'email' => ['nullable', 'email', 'max:100', Rule::unique('companies', 'email')->ignore($this->company)],
            'phone' => ['nullable', 'max:30'],
            'user_id' => ['required', 'exists:users,id'],
        ];
    }
}
