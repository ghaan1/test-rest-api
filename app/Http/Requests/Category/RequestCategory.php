<?php

namespace App\Http\Requests\Category;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;


class RequestCategory extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name_category' => 'required|string|max:255|unique:categories,name_category,' . $this->category,
        ];
    }

    public function messages(): array
    {
        return [
            'name_category.required' => 'Nama kategori harus diisi.',
            'name_category.string' => 'Nama kategori harus berupa huruf',
            'name_category.max' => 'Nama kategori maksimal 255 karakter',
            'name_category.unique' => 'Nama kategori sudah ada',
        ];
    }
}