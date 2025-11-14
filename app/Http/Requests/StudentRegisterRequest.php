<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;


class StudentRegisterRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:users,email',
            ],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'password_confirmation' => ['required'],
            'institution' => ['required'],
            'phone' => [
                'required',
                'regex:/^62[0-9]+$/',   // format WA: diawali 62
                'min:11',               // contoh batas minimal digit
                'max:13',               // contoh batas maksimal digit
            ],
            'address' => ['required'],
            'student_number' => ['required'],
            'major' => ['required'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name'             => 'Name',
            'email'            => 'E-mail',
            'password'         => 'Password',
            'password_confirmation' => 'Konfirmasi Password',
            'institution'      => 'Asal Sekolah / Perguruan Tinggi',
            'phone'            => 'Nomor Telepon',
            'address'          => 'Alamat',
            'student_number'   => 'NIM / NISN / NIS',
            'major'            => 'Jurusan',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute Wajib Diisi.',
            'email'    => ':attribute Harus Berupa :attribute Yang Valid.',
            'unique'   => ':attribute Sudah Ada.',
            'confirmed'=> ':attribute Tidak Sama.',
            'regex'    => ':attribute Harus Dimulai Dengan 62 dan Hanya Boleh Mengandung Angka.',
            'min'      => ':attribute Minimal :min Digit.',
            'max'      => ':attribute Maksimal :max Digit.',
        ];
    }
}
