<?php

namespace App\Http\Livewire\Store;

use App\Models\Store;
use Livewire\Component;

class Detail extends Component
{
    public $store;

    public function mount(Store $store)
    {
        $this->store = $store;
    }

    public function render()
    {
        return view('livewire.store.detail');
    }
}
