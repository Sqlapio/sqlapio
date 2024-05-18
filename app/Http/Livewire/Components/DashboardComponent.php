<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;
use App\Http\Controllers\EstadisticaController;
use App\Http\Controllers\UtilsController;
use Illuminate\Support\Facades\Auth;

class DashboardComponent extends Component
{
    public function render()
    {
        $count_patient_register =  EstadisticaController::total_patient_doctors();
        $count_medical_recordr =  EstadisticaController::total_medical_record(Auth::user()->id);
        $count_history_register =  EstadisticaController::total_history_register();
        $count_patient_genero =  EstadisticaController::total_patient_genero();
        $appointments = UtilsController::get_appointments_dashboard(Auth::user()->id);
        $elderly = UtilsController::get_patient_elderly();
        $boy_girl = UtilsController::get_patient_boy_girl();
        $teen = UtilsController::get_patient_teen();
        $adult = UtilsController::get_patient_adult();
        $ref = UtilsController::get_ref();
        $res_exams = Laboratory::res_exams();
        $res_studies = Laboratory::res_studies();
        $count_study = UtilsController::total_studies();
        $count_examen = UtilsController::total_exams();
        $patients = UtilsController::get_table_medical_record();
        $queries_month = UtilsController::get_queries_month();     
        $appointments_attended = UtilsController::get_appointments_attended();     
        $appointments_canceled = UtilsController::get_appointments_canceled();     
        $appointments_confirmed = UtilsController::get_appointments_confirmed();   
        $appointments_count_all = UtilsController::get_appointments_count_all();     

        return view(
            'livewire.components.dashboard-component',
            compact(
                'count_patient_register',
                'count_medical_recordr',
                'count_history_register',
                'count_patient_genero',
                'appointments',
                'elderly',
                'boy_girl',
                'teen',
                'adult',
                'ref',
                'res_exams',
                'res_studies',
                'count_study',
                'count_examen',
                'patients',
                "queries_month",
                "appointments_attended",
                "appointments_canceled",
                "appointments_confirmed",
                "appointments_count_all"
            )
        );
    }
}
