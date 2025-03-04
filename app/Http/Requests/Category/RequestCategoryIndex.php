<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class RequestCategoryIndex extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'search' => 'nullable|string',
            'column_order' => 'nullable|string',
            'order' => 'nullable|string',
            'per_page' => 'nullable|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'search.string' => 'Search harus berupa huruf',
            'column_order.string' => 'Column order harus berupa huruf',
            'order.string' => 'Order harus berupa huruf',
            'per_page.integer' => 'Per page harus berupa angka',
        ];
    }
}