<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Traits\MessageFixer;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PaymentController extends Controller
{
    use MessageFixer;

    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function callback(Request $request)
    {
        DB::beginTransaction();

        $validator = Validator::make($request->all(), [
            "external_id" => "required|exists:orders,external_id"
        ]);

        if ($validator->fails()) {
            return $this->customMessage("WARNING", false, JsonResponse::HTTP_UNPROCESSABLE_ENTITY, $validator->errors());
        }

        $order = $this->order->where('external_id', $request->external_id)->first();

        try {
            foreach ($order->purchases as $purchase) {
                $purchase->update([
                    "status" => Order::PACKED
                ]);

                $purchase->product()->update([
                    "stock" => $purchase->product->stock - $purchase->qty,
                ]);
            }

            $order->update([
                "status" => "PAID"
            ]);

            DB::commit();
            return $this->successMessage("data berhasil dibayar", $order);
        } catch (\Throwable $th) {
            DB::rollback();
            return $this->errorMessage($th->getMessage());
        }
    }
}
