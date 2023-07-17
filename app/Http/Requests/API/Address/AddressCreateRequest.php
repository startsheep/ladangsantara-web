<?php

namespace App\Http\Requests\API\Address;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class AddressCreateRequest extends FormRequest
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
            "contact_name" => "required",
            "contact_phone" => "required|numeric",
            "province_id" => "required|numeric",
            "regency_id" => "required|numeric",
            "district_id" => "required|numeric",
            "village_id" => "required|numeric",
            "address" => "required",
        ];
    }

    public function attributes()
    {
        return [
            "contact_name" => "nama kontak",
            "contact_phone" => "nomor kontak",
            "province_id" => "provinsi",
            "regency_id" => "kota/kabupaten",
            "district_id" => "kecamatan",
            "village_id" => "desa/kelurahan",
            "address" => "alamat tambahan",
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
