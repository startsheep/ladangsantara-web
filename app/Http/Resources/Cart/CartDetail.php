<?php

namespace App\Http\Resources\Cart;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartDetail extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "status" => "SUCCESS",
            "status_code" => JsonResponse::HTTP_OK,
            "data" => parent::toArray($request)
        ];
    }
}
