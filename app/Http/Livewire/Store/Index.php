<?php

namespace App\Http\Livewire\Store;

use App\Models\Store;
use Illuminate\Support\Facades\DB;
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
            "stores" => $store->paginate(10)
        ];

        return view('livewire.store.index', $data);
    }

    public function delete($id)
    {
        DB::beginTransaction();

        $store = Store::whereId($id)->first();

        try {
            $store->delete();
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
