<?php

namespace App\Http\Livewire\Store;

use App\Models\Store;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search;

    public function render()
    {
        $store = Store::query();
        $store->where(function ($query) {
            $query->where('name', 'LIKE', '%' . $this->search . '%')
                ->orWhereHas('user', function ($query) {
                    $query->where('name', 'LIKE', '%' . $this->search . '%');
                });
        });

        $data = [
            "stores" => $store->paginate(2)
        ];

        return view('livewire.store.index', $data);
    }
}
