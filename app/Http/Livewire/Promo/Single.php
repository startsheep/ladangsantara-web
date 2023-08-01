<?php

namespace App\Http\Livewire\Promo;

use App\Models\Banner;
use Livewire\Component;

class Single extends Component
{
    public $banner, $index;

    public function mount(Banner $banner, $index)
    {
        $this->banner = $banner;
        $this->index = $index;
    }

    public function render()
    {
        return view('livewire.promo.single');
    }
}
