<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Order\OrderRequest;
use App\Http\Traits\MessageFixer;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Xendit\VirtualAccounts;
use Xendit\Xendit;

class OrderController extends Controller
{
    use MessageFixer;

    protected $cart, $order, $address;

    public function __construct(Cart $cart, Order $order, Address $address)
    {
        $this->cart = $cart;
        $this->order = $order;
        $this->address = $address;

        Xendit::setApiKey(config('xendit.secret_key'));
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

        $request->merge([
            "amount" => $amountPurchase,
            "status" => "PENDING",
            "external_id" => "VA-" . uniqid()
        ]);

        try {
            $order = $this->order->create([
                "user_id" => auth()->user()->id,
                "address_id" => $address->id,
                "amount_purchase" => $request->amount,
                "external_id" => $request->external_id,
                "status" => $request->status,
                "payment_channel" => "Virtual Account",
            ]);

            foreach ($carts as $cart) {
                $order->purchases()->create([
                    "product_id" => $cart->product_id,
                    "qty" => $cart->qty
                ]);

                // $cart->delete();
            }

            $this->payment($request);

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

    public function payment($request)
    {
        $params = [
            "external_id" => $request->external_id,
            "bank_code" => $request->bank_code,
            "name" => auth()->user()->name,
            "is_closed" => true,
            "expected_amount" => $request->amount,
            "expiration_date" => Carbon::now()->addDays(1)->toISOString(),
            "is_single_use" => true
        ];

        return VirtualAccounts::create($params);
    }
}
