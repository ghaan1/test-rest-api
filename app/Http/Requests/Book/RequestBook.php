<?php

namespace App\Http\Requests\Category;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;


class RequestBook extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'total_books' => 'required|integer|min:0',
            'fk_category' => 'required|exists:categories,id',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul buku harus diisi.',
            'title.string' => 'Judul buku harus berupa huruf',
            'title.max' => 'Judul buku maksimal 255 karakter',
            'author.required' => 'Penulis harus diisi.',
            'author.string' => 'Penulis harus berupa huruf',
            'author.max' => 'Penulis maksimal 255 karakter',
            'total_books.required' => 'Jumlah buku harus diisi.',
            'total_books.integer' => 'Jumlah buku harus berupa angka',
            'total_books.min' => 'Jumlah buku minimal 0',
            'fk_category.required' => 'Kategori harus diisi.',
            'fk_category.exists' => 'Kategori tidak valid',
        ];
    }
}