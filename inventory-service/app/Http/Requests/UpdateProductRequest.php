<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => 'sometimes|string|max:100|unique:products',
            'price' => 'sometimes|numeric|min:0',
            'description' => 'sometimes|string|max:255',
            'category' => 'sometimes|string|max:100',
            'available' => 'sometimes|boolean',
            'ingredients' => 'sometimes|array',
            'ingredients.*' => 'sometimes|string',
            'quantity' => 'sometimes|integer|min:0'
        ];
    }
}
