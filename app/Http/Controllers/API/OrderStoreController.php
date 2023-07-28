<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Filters\OrderStore\ShowByStatus;
use App\Http\Filters\OrderStore\ShowByStore;
use App\Http\Resources\OrderStore\OrderStoreCollection;
use App\Http\Resources\OrderStore\OrderStoreDetail;
use App\Http\Traits\MessageFixer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;

class OrderStoreController extends Controller
{
    use MessageFixer;

    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
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
}
