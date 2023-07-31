<?php

namespace App\Http\Livewire\User;

use App\Models\Order;
use App\Models\User;
use Livewire\Component;

class Detail extends Component
{
    public $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.user.detail');
    }
}
