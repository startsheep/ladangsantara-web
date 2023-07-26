<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Filters\Order\ShowAddress;
use App\Http\Filters\Order\ShowByStatus;
use App\Http\Filters\Order\ShowByUser;
use App\Http\Filters\Order\ShowUser;
use App\Http\Requests\API\Order\OrderRequest;
use App\Http\Resources\Order\OrderCollection;
use App\Http\Resources\Order\OrderDetail;
use App\Http\Traits\MessageFixer;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
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

    public function index(Request $request)
    {
        $orders = app(Pipeline::class)
            ->send($this->order->query())
            ->through([
                ShowUser::class,
                ShowByUser::class,
                ShowAddress::class,
                ShowByStatus::class,
            ])
            ->thenReturn()
            ->paginate($request->per_page);

        return new OrderCollection($orders);
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

                $cart->delete();
            }

            $this->payment($request);

            DB::commit();
            return $this->successMessage("pesanan berhasil disimpan", $order);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->errorMessage($th->getMessage());
        }
    }

    public function show(Request $request, $id)
    {
        $order = $this->order->find($id);
        if (!$order) {
            return $this->warningMessage("data pesanan tidak ditemukan.");
        }

        if ($request->has('user') && $request->user == "true") {
            $order->load('user');
        }

        if ($request->has('address') && $request->address == "true") {
            $order->load('address');
        }

        return new OrderDetail($order);
    }

    public function cancel(Request $request, $id)
    {
        DB::beginTransaction();

        $order = $this->order->find($id);
        if (!$order) {
            return $this->warningMessage("data pesanan tidak ditemukan.");
        }

        try {
            foreach ($order->purchases as $purchase) {
                $purchase->update([
                    "status" => Order::CANCELED
                ]);

                $purchase->product()->update([
                    "stock" => $purchase->product->stock + $purchase->qty,
                ]);
            }

            $order->update([
                "status" => "CANCELED"
            ]);

            DB::commit();
            return $this->successMessage("pesanan berhasil dibatalkan", $order);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->errorMessage($th->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
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
