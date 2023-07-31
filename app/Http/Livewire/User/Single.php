<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

class Single extends Component
{
    public $user, $index;

    public function mount(User $user, $index)
    {
        $this->user = $user;
        $this->index = $index;
    }

    public function render()
    {
        return view('livewire.user.single');
    }
}
