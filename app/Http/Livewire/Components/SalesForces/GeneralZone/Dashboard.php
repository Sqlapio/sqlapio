<?php

namespace App\Http\Livewire\Components\SalesForces\GeneralZone;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {

        $user_vm = User::where('master_corporate_id', Auth::user()->id)->get();

        return view('livewire.components.sales-forces.general-zone.dashboard',compact('user_vm'));
    }
}
