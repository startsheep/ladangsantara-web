<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Filters\OrderStore\ShowByStatus;
use App\Http\Filters\OrderStore\ShowByStore;
use App\Http\Resources\OrderStore\OrderStoreCollection;
use App\Http\Resources\OrderStore\OrderStoreDetail;
use App\Http\Traits\MessageFixer;
use App\Models\Order;
use App\Models\Purchase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderStoreController extends Controller
{
    use MessageFixer;

    protected $order, $purchase;

    public function __construct(Order $order, Purchase $purchase)
    {
        $this->order = $order;
        $this->purchase = $purchase;
    }

    public function index(Request $request)
    {
        $orders = app(Pipeline::class)
            ->send($this->order->query())
            ->through([
                ShowByStore::class,
                ShowByStatus::class,
            ])
            ->thenReturn()
            ->paginate($request->per_page);

        return new OrderStoreCollection($orders);
    }

    public function show(Request $request, $id)
    {
        $order = $this->order->whereHas('purchases.product.store', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->where('id', $id)->first();

        if (!$order) {
            return $this->warningMessage("data pesanan tidak ditemukan.");
        }

        if ($request->has('user') && $request->user == "true") {
            $order->load('user');
        }

        if ($request->has('address') && $request->address == "true") {
            $order->load('address');
        }

        if ($request->has('purchases') && $request->purchases == "true") {
            $order->load('purchases.product');
        }

        return new OrderStoreDetail($order);
    }

    public function updateStatus(Request $request)
    {
        DB::beginTransaction();

        $validator = Validator::make($request->all(), [
            "order_item" => "array|required",
            "order_item.*" => "required|exists:purchases,id",
            "status" => "required"
        ]);

        if ($validator->fails()) {
            return $this->customMessage("WARNING", false, JsonResponse::HTTP_UNPROCESSABLE_ENTITY, $validator->errors());
        }

        $purchases = $this->purchase
            ->whereHas("product.store", function ($query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->whereIn("id", $request->order_item)
            ->get();

        if ($purchases->count() < 1) {
            return $this->warningMessage("pesanan tidak ditemukan");
        }

        try {

            foreach ($purchases as $purchase) {
                $purchase->update([
                    "status" => $request->status
                ]);
            }

            DB::commit();
            return $this->successMessage("item berhasil diperbaharui", $purchases);
        } catch (\Throwable $th) {
            DB::rollback();
            return $this->errorMessage($th->getMessage());
        }
    }
}
