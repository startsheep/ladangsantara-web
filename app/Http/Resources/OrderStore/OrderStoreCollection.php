<?php

namespace App\Http\Resources\OrderStore;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderStoreCollection extends ResourceCollection
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

            foreach ($items as $item) {
                $storeData["user"] = $item->user;
                $storeData["order_items"] = $item->purchases;
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
