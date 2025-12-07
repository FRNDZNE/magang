<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LogbookImageRequest extends FormRequest
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
            'image' => 'required|file|image|mimes:jpeg,png,jpg,webp,gif,svg|max:5120',
        ];
    }

    public function attributes() : array
    {
        return [
            'image' => 'File Gambar',
        ];
    }


    public function messages() : array
    {
        return [
            'required' => ':attribute tidak boleh kosong',
            'image'    => ':attribute harus berupa gambar',
            'mimes'    => ':attribute harus berformat jpeg, png, jpg, webp, gif, atau svg',
            'max'      => ':attribute maksimal berukuran 5 MB',
        ];
    }
}
