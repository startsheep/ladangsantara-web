<?php

namespace App\Http\Resources\Banner;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BannerCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
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
