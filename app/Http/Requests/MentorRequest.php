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
            'guard_name' => 'required'
        ];
    }

    public function attributes() : array
    {
        return [
            'name' => 'Nama Role',
            'guard_name' => 'Nama Display'
        ];
    }


    public function messages() : array
    {
        return [
            'required' => ':attribute Tidak Boleh Kosong',
            'regex' => ':attribute Tidak Boleh Mengandung Spasi',
        ];
    }
}
