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
        $specialty = CorporateController::specialty();
        $user_asociate = CorporateController::user_asociate();
        $patient_corporate = CorporateController::get_patient_corporate();
        $doctor_speciality = CorporateController::get_doctor_speciality();
        $patient_attended_corporate = CorporateController::get_patient_attended_corporate();

        return view(
            'livewire.components.profile_corporate.dashboard',
            compact(
                'patients',
                'dortors',
                'doctor_active',
                'doctor_inacactive',
                'dairy_unconfirmed_master_corporate',
                'meses',
                'user_asociate',
                'patient_corporate',
                'patient_attended_corporate',
                'doctor_speciality',
                'specialty',
            )
        );
    }
}
