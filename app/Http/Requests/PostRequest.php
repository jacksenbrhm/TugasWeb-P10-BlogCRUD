<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Aturan validasi dipakai bersama oleh store() dan update(),
 * sehingga controller tetap bersih.
 */
class PostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'  => ['required', 'string', 'max:200'],
            'author' => ['required', 'string', 'max:100'],
            'body'   => ['required', 'string', 'min:10'],
            'image'  => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:2048'], // BONUS upload gambar
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'  => 'Judul wajib diisi.',
            'title.max'       => 'Judul maksimal :max karakter.',
            'author.required' => 'Nama penulis wajib diisi.',
            'author.max'      => 'Nama penulis maksimal :max karakter.',
            'body.required'   => 'Isi post wajib diisi.',
            'body.min'        => 'Isi post minimal :min karakter.',
            'image.image'     => 'File harus berupa gambar.',
            'image.mimes'     => 'Format gambar harus jpeg, jpg, png, atau webp.',
            'image.max'       => 'Ukuran gambar maksimal 2 MB.',
        ];
    }
}
