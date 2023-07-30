<?php

namespace App\Http\Livewire\Product;

use App\Models\Product;
use Livewire\Component;

class Single extends Component
{
    public $product, $index;

    public function mount(Product $product, $index)
    {
        $this->product = $product;
        $this->index = $index;
    }

    public function render()
    {
        return view('livewire.product.single');
    }
}
