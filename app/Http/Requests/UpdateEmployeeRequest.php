<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $employeeId = $this->route('employee');

        return [
            'full_name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('employees', 'email')->ignore($employeeId)],
            'mobile' => ['required', 'string', 'max:20', Rule::unique('employees', 'mobile')->ignore($employeeId)],
            'department' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'skills' => 'required|array',
            'skills.*' => 'exists:skills,id',
            'avatar'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }
}
