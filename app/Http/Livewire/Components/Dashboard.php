<?php

namespace App\Http\Livewire\Components;

use App\Http\Controllers\CorporateController;
use Livewire\Component;
use App\Http\Controllers\UtilsController;
use Illuminate\Support\Facades\Auth;


class Dashboard extends Component
{
    public function render()
    {
        $patients = CorporateController::get_patient_corporate();
        $dortors = UtilsController::get_doctor_corporate();
        $doctor_active = UtilsController::get_doctor_active();
        $doctor_inacactive = UtilsController::get_doctor_inacactive();
        $dairy_unconfirmed_master_corporate = UtilsController::get_appointments_unconfirmed_master_corporate();
        $meses = UtilsController::meses();

        return view(
            'livewire.components.profile_corporate.dashboard',
            compact(
                'patients',
                'dortors',
                'doctor_active',
                'doctor_inacactive',
                'dairy_unconfirmed_master_corporate',
                'meses',
            )
        );
    }
}
