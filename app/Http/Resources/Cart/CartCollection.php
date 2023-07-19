<?php

namespace App\Http\Resources\Cart;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CartCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [];

        $groupedData = collect($this)->groupBy(function ($item) {
            return $item['product']['store'];
        });

        foreach ($groupedData as $storeName => $items) {
            $storeData = [
                "store" => json_decode($storeName, true),
                "cart_items" => []
            ];

            foreach ($items as $item) {
                $storeData["cart_items"][] = $item;
            }

            $data[] = $storeData;
        }

        return [
            "status" => "SUCCESS",
            "status_code" => JsonResponse::HTTP_OK,
            "data" => $data
        ];
    }
}
