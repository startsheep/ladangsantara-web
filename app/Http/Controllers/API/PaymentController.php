<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Traits\MessageFixer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $order = $this->order->where('external_id', $request->external_id)->first();

        try {
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
