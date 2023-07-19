<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Order\OrderRequest;
use App\Http\Traits\MessageFixer;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    use MessageFixer;

    protected $cart, $order, $address;

    public function __construct(Cart $cart, Order $order, Address $address)
    {
        $this->cart = $cart;
        $this->order = $order;
        $this->address = $address;
    }

    public function index()
    {
        //
    }

    public function store(OrderRequest $request)
    {
        DB::beginTransaction();

        $amountPurchase = 0;

        $address = $this->address->where([
            "user_id" => auth()->user()->id,
            "is_default" => Address::ACTIVE
        ])->first();
        if (!$address) {
            return $this->warningMessage("alamat tidak ditemukan.");
        }

        $carts = $this->cart->whereIn('id', $request->cart_ids)->get();

        foreach ($carts as $cart) {
            $amountPurchase = $cart->product->price * $cart->qty;
        }

        try {
            $order = $this->order->create([
                "user_id" => auth()->user()->id,
                "address_id" => $address->id,
                "amount_purchase" => $amountPurchase
            ]);

            foreach ($carts as $cart) {
                $order->purchases()->create([
                    "product_id" => $cart->product_id,
                    "qty" => $cart->qty
                ]);

                $cart->delete();
            }

            DB::commit();
            return $this->successMessage("pesanan berhasil disimpan", $order);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->errorMessage($th->getMessage());
        }
    }

    public function show(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
