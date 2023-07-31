<?php

namespace App\Http\Livewire\Product;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Single extends Component
{
    public $product, $index, $dataId;

    protected $listeners = ["deleteData"];

    protected function getListeners()
    {
        return [
            'deleteData' => 'delete',
        ];
    }

    public function mount(Product $product, $index)
    {
        $this->product = $product;
        $this->index = $index;
    }

    public function confirmDelete($id)
    {
        $this->dataId = $id;

        $this->dispatchBrowserEvent("showDeleteConfirmation");
    }

    public function delete()
    {
        DB::beginTransaction();

        try {
            if ($this->product->image) {
                $path = str_replace(url('storage') . '/', '', $this->product->image);
                Storage::delete($path);
            }

            $this->product->delete();

            DB::commit();
            $this->dataId = null;
            return $this->dispatchBrowserEvent('showDeleteSuccess');
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.product.single');
    }
}
