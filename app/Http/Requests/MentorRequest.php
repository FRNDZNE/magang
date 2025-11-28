<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MentorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required'],

            // email berada di tabel users
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->mentor?->uuid, 'uuid'),
                // abaikan user dengan email yang sama jika sedang mengedit
            ],

            'password' => [
                $this->mentor ? 'nullable' : 'required',
                // saat edit password boleh kosong
            ],

            'division_id'     => ['required'],
            'employee_number' => ['required'],
            'phone'           => [
                'required',
                'regex:/^62[0-9]+$/',
                'min:10',
                'max:13',
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'name'            => 'Nama',
            'email'           => 'E-Mail',
            'password'        => 'Password',
            'division_id'     => 'Divisi',
            'employee_number' => 'Nomor Registrasi Pegawai',
            'phone'           => 'Nomor Telepon',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute Tidak Boleh Kosong',
            'email'    => ':attribute harus berupa alamat email yang valid',
            'unique' => ':attribute sudah digunakan',
            'regex' => ':attribute harus menggunakan format 62xxxxxxxxxxx dan hanya angka.',
            'min' => ':attribute Minimal :min Digit',
            'max' => ':attribute Maksimal :max Digit',
        ];
    }
}
