<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required'],
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->student?->uuid, 'uuid'),
            ],

            'password' => [
                $this->student ? 'nullable' : 'required',
            ],

            'student_number' => ['required'],
            'institution'    => ['required'],
            'major'          => ['required'],
            'phone'          => [
                'required',
                'regex:/^62[0-9]+$/',
                'min:10',
                'max:13',
            ],
            'address'        => ['required'],


        ];
    }

    public function attributes(): array
    {
        return [
            'name'           => 'Nama',
            'email'          => 'E-Mail',
            'password'       => 'Password',
            'student_number' => 'NIM/NRP',
            'institution'   => 'Institusi',
            'major'         => 'Jurusan',
            'phone'         => 'Nomor Telepon',
            'address'       => 'Alamat',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute Tidak Boleh Kosong',
            'email'    => ':attribute harus berupa alamat email yang valid',
            'unique'   => ':attribute sudah digunakan',
            'regex'    => ':attribute harus menggunakan format 62xxxxxxxxxxx dan hanya angka',
            'min'      => ':attribute minimal :min Digit',
            'max'      => ':attribute maksimal :max Digit',
        ];
    }
}
