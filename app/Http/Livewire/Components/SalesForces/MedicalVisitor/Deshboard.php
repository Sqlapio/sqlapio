<?php

namespace App\Http\Livewire\Components\SalesForces\MedicalVisitor;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Deshboard extends Component
{
    public function render()
    {

        $medicos_vm = User::where('master_corporate_id', Auth::user()->id)->get();

        return view('livewire.components.sales-forces.medical-visitor.deshboard',compact('medicos_vm'));
    }
}
