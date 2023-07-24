<?php

namespace App\Http\Requests\API\Order;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class OrderRequest extends FormRequest
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
            'cart_ids' => 'required|array',
            'cart_ids.*' => 'required|exists:carts,id',
            'bank_code' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'cart_ids' => 'keranjang',
            'cart_ids.*' => 'keranjang',
            'bank_code' => 'kode bank',
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
