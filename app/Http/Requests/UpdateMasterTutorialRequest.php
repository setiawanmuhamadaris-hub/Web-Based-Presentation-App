<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMasterTutorialRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'judul'            => ['required', 'string', 'max:255'],
            'kode_matkul'      => ['required', 'string', 'max:20'],
            'url_presentation' => ['required', 'string', 'max:100',
                                   'unique:master_tutorials,url_presentation,' . $this->tutorial->id,
                                   'regex:/^[a-z0-9\-]+$/'],
            'url_finished'     => ['required', 'string', 'max:100',
                                   'unique:master_tutorials,url_finished,' . $this->tutorial->id,
                                   'regex:/^[a-z0-9\-]+$/'],
        ];
    }

    public function messages(): array
    {
        return [
            'url_presentation.regex' => 'Hanya huruf kecil, angka, dan tanda hubung.',
            'url_finished.regex'     => 'Hanya huruf kecil, angka, dan tanda hubung.',
        ];
    }
}
