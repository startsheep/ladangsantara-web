<?php

namespace App\Http\Livewire\Promo;

use App\Models\Banner;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $banner = Banner::paginate(10);

        return view('livewire.promo.index', [
            "banners" => $banner
        ]);
    }

    public function delete($id)
    {
        DB::beginTransaction();

        $banner = Banner::whereId($id)->first();

        try {
            $banner->delete();
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
