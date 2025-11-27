<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InternRequestForStudent extends FormRequest
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
            'division' => 'required',
            'start_date' => 'requested|date',
            'end_date' => 'requested|date|after_or_equal:start_date',
        ];
    }

    public function attributes() : array
    {
        return [
            'division_id' => 'Divisi',
            'start_date'  => 'Tanggal Mulai',
            'end_date'    => 'Tanggal Selesai',
        ];
    }


    public function messages() : array
    {
        return [
            'required' => ':attribute Tidak Boleh Kosong',
            'date'     => ':attribute harus berupa tanggal yang valid',
            'after_or_equal' => ':attribute harus sama dengan atau setelah Tanggal Mulai',
        ];
    }
}
