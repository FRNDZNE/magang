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
            'id' => 'nullable',
            'date' => 'required',
            'status' => 'required',
            'notes' => 'nullable',
        ];
    }

    public function attributes() : array
    {
        return [
            'id' => 'ID',
            'date' => 'Tanggal',
            'status' => 'Status Kehadiran',
            'notes' => 'Alasan'
        ];
    }


    public function messages() : array
    {
        return [
            'required' => ':attribute Tidak Boleh Kosong',
        ];
    }
}
