<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MentorRequest extends FormRequest
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
            'employee_number' => 'required|string|unique:mentors,employee_number,',
            'phone' => 'required|string|max:15',
            'user_id' => 'required|exists:users,id',
            'division_id' => 'required|exists:divisions,id',
        ];
    }

        public function messages(): array
    {
        return [
            'employee_number.required' => 'The employee number is required.',
            'employee_number.string' => 'The employee number must be a string.',
            'employee_number.unique' => 'The employee number has already been taken.',
            'phone.required' => 'The phone number is required.',
            'phone.string' => 'The phone number must be a string.',
            'phone.max' => 'The phone number may not be greater than 15 characters.',
            'user_id.required' => 'The user is required.',
            'user_id.exists' => 'The selected user is invalid.',
            'division_id.required' => 'The division is required.',
            'division_id.exists' => 'The selected division is invalid.',
        ];
    }
}
