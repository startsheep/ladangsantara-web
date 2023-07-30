<?php

namespace App\Http\Livewire\Store;

use App\Models\Store;
use Livewire\Component;

class Detail extends Component
{
    public $store;

    protected $listeners = ["reloadData"];

    protected function getListeners()
    {
        return [
            'reloadData' => 'reload'
        ];
    }

    public function mount(Store $store)
    {
        $this->store = $store;
    }

    public function render()
    {
        $products = $this->store->products()->paginate(10);

        return view('livewire.store.detail', compact('products'));
    }

    public function reload()
    {
        return $this->render();
    }
}
