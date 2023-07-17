<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Filters\Cart\ShowByUser;
use App\Http\Filters\Cart\ShowProduct;
use App\Http\Filters\Cart\ShowUser;
use App\Http\Requests\API\Cart\CartRequest;
use App\Http\Resources\Cart\CartCollection;
use App\Http\Resources\Cart\CartDetail;
use App\Http\Traits\MessageFixer;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    use MessageFixer;

    protected $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function index(Request $request)
    {
        $carts = app(Pipeline::class)
            ->send($this->cart->query())
            ->through([
                ShowUser::class,
                ShowProduct::class,
                ShowByUser::class
            ])
            ->thenReturn()
            ->paginate($request->per_page);

        return new CartCollection($carts);
    }

    public function store(CartRequest $request)
    {
        DB::beginTransaction();

        $request->merge([
            "user_id" => auth()->user()->id
        ]);

        try {
            $cart = $this->cart->where([
                "user_id" => auth()->user()->id,
                "product_id" => $request->product_id
            ])->first();

            if ($cart) {
                $cart->update([
                    "qty" => $cart->qty + $request->qty
                ]);
            } else {
                $cart = $this->cart->create($request->all());
            }

            DB::commit();
            return $this->successMessage("produk berhasil disimpan di keranjang", $cart);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->errorMessage($th->getMessage());
        }
    }

    public function show(Request $request, $id)
    {
        $cart = $this->cart->find($id);
        if (!$cart) {
            return $this->warningMessage("data keranjang tidak ditemukan.");
        }

        if ($request->has('user') && $request->user == "true") {
            $cart->load('user');
        }

        if ($request->has('product') && $request->product == "true") {
            $cart->load('product.store');
        }

        return new CartDetail($cart);
    }

    public function addQty($id)
    {
        DB::beginTransaction();

        $cart = $this->cart->find($id);
        if (!$cart) {
            return $this->warningMessage("data keranjang tidak ditemukan.");
        }

        if ($cart->qty + 1 == $cart->product->stock) {
            return $this->warningMessage("jumlah produk melebihi stok produk");
        }

        try {
            $cart->update([
                "qty" => $cart->qty + 1
            ]);
            DB::commit();
            return $this->successMessage("jumlah produk berhasil ditambah", $cart);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->errorMessage($th->getMessage());
        }
    }

    public function reduceQty($id)
    {
        DB::beginTransaction();

        $cart = $this->cart->find($id);
        if (!$cart) {
            return $this->warningMessage("data keranjang tidak ditemukan.");
        }


        try {
            if ($cart->qty - 1 == 0) {
                $this->destroy($id);
            }

            $cart->update([
                "qty" => $cart->qty - 1
            ]);

            DB::commit();
            return $this->successMessage("jumlah produk berhasil dikurangi", $cart);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->errorMessage($th->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        $cart = $this->cart->find($id);
        if (!$cart) {
            return $this->warningMessage("data keranjang tidak ditemukan.");
        }

        try {
            $cart->delete();

            DB::commit();
            return $this->successMessage("data keranjang berhasil dihapus", $cart);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->errorMessage($th->getMessage());
        }
    }
}
