<?php

namespace App\Http\Livewire\Store;

use App\Models\Store;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Single extends Component
{
    public $store, $index;

    public function mount(Store $store, $index)
    {
        $this->store = $store;
        $this->index = $index;
    }

    public function render()
    {
        return view('livewire.store.single');
    }

    public function delete()
    {
        DB::beginTransaction();

        try {
            if ($this->store->logo) {
                $path = str_replace(url('storage') . '/', '', $this->store->logo);
                Storage::delete($path);
            }

            $this->store->delete();

            DB::commit();
            $this->render();
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }
}
