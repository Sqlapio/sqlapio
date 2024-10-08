<?php

namespace App\Http\Livewire\Components;

use App\Http\Controllers\CorporateController;
use App\Http\Controllers\UtilsController;
use Livewire\Component;

class AdminPatients extends Component
{
    public function render()
    {
        //list de pacinetes
        $patients = CorporateController::get_patient_corporate();
        
        return view('livewire.components.profile_corporate.admin-patients',compact('patients'));
    }
}
