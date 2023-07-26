<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderCollection extends ResourceCollection
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
            return collect($item['purchases'])->groupBy(function ($item) {
                return $item['product']['store'];
            });
        });

        foreach ($groupedData as $store => $items) {
            $storeData = [];

            foreach (json_decode($store) as $store => $value) {
                $storeData["store"] = json_decode($store, true);
                $storeData["order_items"] = $value;
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
