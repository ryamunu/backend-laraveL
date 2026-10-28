<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

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
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0.01',
            'stock'       => 'required|integer|min:0',
            'category_id' => 'required|integer|exists:categories,id',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required'        => 'El campo nombre es requerido.',
            'name.max'             => 'El nombre no puede exceder los 255 caracteres.',
            'price.required'       => 'El campo precio es requerido.',
            'price.numeric'        => 'El precio debe ser un valor numérico.',
            'price.min'            => 'El precio debe ser mayor que 0.',
            'stock.required'       => 'El campo stock es requerido.',
            'stock.integer'        => 'El stock debe ser un número entero.',
            'stock.min'            => 'El stock no puede ser negativo.',
            'category_id.required' => 'La categoría es requerida.',
            'category_id.exists'   => 'La categoría seleccionada no existe.',
        ];
    }

    /**
     * Handle a failed validation attempt — return standardized JSON.
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Error de validación',
            'errors'  => $validator->errors()->toArray(),
        ], 422));
    }
}
