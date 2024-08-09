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

        $id= (Auth::user()->role=="secretary") ? Auth::user()->master_corporate_id : Auth::user()->id;

        $count_patient_register =  EstadisticaController::total_patient_doctors($id);
        $count_medical_recordr =  EstadisticaController::total_medical_record($id);
        $count_history_register =  EstadisticaController::total_history_register($id);
        $count_patient_genero =  EstadisticaController::total_patient_genero();
        $appointments = UtilsController::get_appointments_dashboard($id);
        $elderly = UtilsController::get_patient_elderly($id);
        $boy_girl = UtilsController::get_patient_boy_girl($id);
        $teen = UtilsController::get_patient_teen($id);
        $adult = UtilsController::get_patient_adult($id);
        $ref = UtilsController::get_ref();
        $res_exams = Laboratory::res_exams($id);
        $res_studies = Laboratory::res_studies($id);
        $count_study = UtilsController::total_studies($id);
        $count_examen = UtilsController::total_exams();
        $patients = UtilsController::get_table_medical_record($id);
        $queries_month = UtilsController::get_queries_month(null,$id);
        $appointments_attended = UtilsController::get_appointments_attended(null,$id);
        $appointments_canceled = UtilsController::get_appointments_canceled(null,$id);
        $appointments_confirmed = UtilsController::get_appointments_confirmed(null,$id);
        $appointments_unconfirmed = UtilsController::get_appointments_unconfirmed(null,$id);
        $appointments_count_all_attended = UtilsController::get_appointments_count_all_attended($id);
        $appointments_count_all_canceled = UtilsController::get_appointments_count_all_canceled($id);
        $appointments_count_all_confirmada = UtilsController::get_appointments_count_all_confirmada($id);


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
                "appointments_unconfirmed",
                "appointments_count_all_attended",
                "appointments_count_all_confirmada",
                "appointments_count_all_canceled",
            )
        );
    }
}
