<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:3',
            'price' => 'required|numeric',
            'category' => 'required|string|max:120',
            'image_url' => 'nullable|url',
        ];

        if($this->method() === 'PUT') {
            $rules['name'] = 'nullable|string|min:3|max:255';
            $rules['description'] = 'nullable|string|min:3';
            $rules['price'] = 'nullable|numeric';
            $rules['category'] = 'nullable|string|max:120';
            $rules['image_url'] = 'nullable|url';
        }

        return $rules;
    }
}
