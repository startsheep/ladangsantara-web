<?php

namespace App\Http\Requests\API\Product;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class ProductCreateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'image_product' => 'required|image|mimes:png,jpg,jpeg',
            'category' => 'required|in:Buah,Sayur',
            'description' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nama produk',
            'price' => 'harga produk',
            'stock' => 'stok produk',
            'image_product' => 'gambar produk',
            'category' => 'kategori produk',
            'description' => 'deskripsi produk',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = new JsonResponse([
            'status' => 'WARNING',
            'status_code' => JsonResponse::HTTP_UNPROCESSABLE_ENTITY,
            'messages' => $validator->errors()
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);

        throw new ValidationException($validator, $response);
    }
}
