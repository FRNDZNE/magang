<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SelectMentorRequest extends FormRequest
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
            'mentor_id' => 'required',
        ];
    }

    public function attributes() : array
    {
        return [
            'mentor_id' => 'Mentor',
        ];
    }


    public function messages() : array
    {
        return [
            'required' => ':attribute Tidak Boleh Kosong',
        ];
    }
}
