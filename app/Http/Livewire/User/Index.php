<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public $search;

    public function render()
    {
        $user = User::query();

        $user->where("role_id", User::MEMBER);
        $user->where(function ($query) {
            $query->where('name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('email', 'LIKE', '%' . $this->search . '%');
        });

        $data = [
            "users" => $user->paginate(10)
        ];

        return view('livewire.user.index')->with($data);
    }
}
