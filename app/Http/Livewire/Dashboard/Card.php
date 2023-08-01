<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Banner;
use App\Models\Order;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Livewire\Component;

class Card extends Component
{
    public function render()
    {
        $amount = 0;

        foreach (Order::all() as $order) {
            $amount += $order->amount_purchase;
        }

        foreach (Banner::all() as $banner) {
            $amount += 150000;
        }

        $data = [
            "totalUser" => User::where('role_id', User::MEMBER)->count(),
            "totalStore" => Store::count(),
            "totalProduct" => Product::count(),
            "totalIncome" => $amount,
        ];

        return view('livewire.dashboard.card', $data);
    }
}
