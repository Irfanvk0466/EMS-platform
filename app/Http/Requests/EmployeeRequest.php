<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'mobile' => 'required|string|max:20',
            'department' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'skills' => 'required|array',
            'skills.*' => 'exists:skills,id',
            'avatar'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }
}
