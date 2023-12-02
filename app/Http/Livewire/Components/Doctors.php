<?php

namespace App\Http\Livewire\Components;

use App\Http\Controllers\UtilsController;
use Livewire\Component;

class Doctors extends Component
{
    public function render()
    {
        //list de medicos
        $dortors = UtilsController::get_doctor_corporate();
        
        return view('livewire.components.profile_corporate.doctors',compact('dortors'));
    }
}
