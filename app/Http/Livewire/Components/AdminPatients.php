<?php

namespace App\Http\Livewire\Components;

use App\Http\Controllers\UtilsController;
use Livewire\Component;

class AdminPatients extends Component
{
    public function render()
    {
        //list de pacinetes
        $patients = UtilsController::get_patient_corporate();
        return view('livewire.components.profile_corporate.admin-patients',compact('patients'));
    }
}
