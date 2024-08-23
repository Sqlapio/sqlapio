<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;
use App\Http\Controllers\UtilsController;
use Illuminate\Support\Facades\Auth;


class Dashboard extends Component
{
    public function render()
    {
        $patients = UtilsController::get_patient_corporate();
        $dortors = UtilsController::get_doctor_corporate();
        $doctor_active = UtilsController::get_doctor_active();
        $doctor_inacactive = UtilsController::get_doctor_inacactive();        

        return view(
            'livewire.components.profile_corporate.dashboard',
            compact(
                'patients',
                'dortors',
                'doctor_active',
                'doctor_inacactive',
            )
        );
    }
}
