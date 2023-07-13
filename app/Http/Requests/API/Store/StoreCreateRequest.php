<?php

namespace App\Http\Requests\API\Store;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class StoreCreateRequest extends FormRequest
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
            "name" => "required",
            "description" => "required",
            "address" => "required|max:255",
            "lat" => "required",
            "long" => "required",
            "logo" => "image|mimes:png,jpg,jpeg",
        ];
    }

    public function attributes()
    {
        return [
            "name" => "nama toko",
            "description" => "deskripsi toko",
            "address" => "alamat toko",
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
