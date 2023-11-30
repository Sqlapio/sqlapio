<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class AdminPatients extends Component
{
    public function render()
    {

        //list de pacinetes
        return view('livewire.components.profile_corporate.admin-patients');
    }
}
