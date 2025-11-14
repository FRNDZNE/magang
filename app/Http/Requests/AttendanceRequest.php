<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttendanceRequest extends FormRequest
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
            "date" => "required|date",
            "status" => "required|in:present,absent,late,excused",
            "intern_id" => "required|exists:interns,id",
            "validated" => "boolean",
            "notes" => "nullable|string",
        ];
    }

    public function messages(): array
    {
        return [
            'date.required' => 'The date is required.',
            'date.date' => 'The date is not a valid date.',
            'status.required' => 'The status is required.',
            'status.in' => 'The selected status is invalid.',
            'intern_id.required' => 'The intern is required.',
            'intern_id.exists' => 'The selected intern is invalid.',
            'validated.boolean' => 'The validated field must be true or false.',
            'notes.string' => 'The notes must be a string.',
        ];
    }
}
