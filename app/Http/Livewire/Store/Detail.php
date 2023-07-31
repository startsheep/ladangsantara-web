<?php

namespace App\Http\Livewire\Store;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Support\Facades\DB;
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
        $products = $this->store->products()->paginate(10);

        return view('livewire.store.detail', compact('products'));
    }

    public function delete($id)
    {
        DB::beginTransaction();

        $product = Product::whereId($id)->first();

        try {
            $product->delete();
            DB::commit();
            $this->render();
            $this->dispatchBrowserEvent(
                'toastr',
                ['type' => 'success',  'message' => 'data berhasil dihapus!']
            );
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th->getMessage());
        }
    }
}
