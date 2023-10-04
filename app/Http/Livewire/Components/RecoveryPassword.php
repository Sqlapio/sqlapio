<?php

namespace App\Http\Livewire\Components;

use Illuminate\Http\Request;
use Livewire\Component;

class RecoveryPassword extends Component
{

    public function create_password_temporary(Request $request)
    {
       dd($request);
    }


    public function render()
    {
        return view('livewire.components.recovery-password');
    }
}
