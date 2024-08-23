<?php

namespace App\Http\Livewire\Components;

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\UtilsController;
use App\Models\Center;
use App\Models\History;
use App\Models\Interview;
use App\Models\Patient;
use App\Models\VacunaCovid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ClinicalHistory extends Component
{
    public function store(Request $request)
    {
        try {
                $this->validate($request, [
                    'reason_visit'  => 'required',
                    'physical_exam' => 'required',
                    'diagnosis'     => 'required',
                    'medication'    => 'required',
                    'image_exam'    => 'required',
                    'image_other'   => 'required',
                ],[
                    'reason_visit.required' => __('messages.alert.razon_obligatorio'),
                    'physical_exam.required'=> __('messages.alert.examen_fisico_requerido'),
                    'diagnosis.required'    => __('messages.alert.diagnostico_obligatorio'),
                    'medication.required'   => __('messages.alert.tratamiento_obligatorio'),
                    'image_exam.required'   => __('messages.alert.img_exam_requerido'),
                    'image_other.required'  => __('messages.alert.img_other_requerido'),
                ]);

                $interview = new Interview();
                $interview->user_id = Auth::user()->id;
                $interview->patient_id = $request->patient_id;
                $interview->center_id = $request->center_id;
                $interview->reason_visit = $request->reason_visit;
                $interview->physical_exam = $request->physical_exam;
                $interview->diagnosis = $request->diagnosis;
                $interview->medication = $request->medication;
                $interview->image_exam = $request->image_exam;
                $interview->image_other = $request->image_other;
                $interview->save();

                $action = '8';
                ActivityLogController::store_log($action);

                /**
                 * Logica para el envio de la notificacion
                 * via correo electronico
                 *
                 * @uses
                 * Esta logica solo sera aplicada si el usuario
                 * realizo la confirmacion del correo electronico
                 */

                $doctor_email = Auth::user()->email;

                if($doctor_email != null)
                {
                    $patient = Patient::where('id', $request->patient_id)->get();

                    foreach ($patient as $item)
                    {
                        $name = $item->name;
                        $last_name = $item->last_name;
                    }

                    $title = 'Mail de SqlapioTechnology';
                    $body = [
                        'cuerpo' => __('messages.alert.registro_historia'),
                        'name' => $name.' '.$last_name,
                        'name' => $name.' '.$last_name,
                    ];

                    UtilsController::notification_email($doctor_email, $title, $body);
                }

                return true;

        } catch (\Throwable $th) {
            return response()->json([
                'success' => 'false',
                'errors'  => $th->getMessage()
            ], 500);
        }

    }

    public function render(Request $request,$id)
    {
        $history = UtilsController::get_history($id);
        $Patient = UtilsController::get_one_patient($id);
        $validateHistory = $Patient->get_history;
        $vital_sing = UtilsController::get_history_vital_sing();
        $family_back = UtilsController::get_history_family_back();
        $pathology_back = UtilsController::get_history_pathology_back();
        $non_pathology_back = UtilsController::get_history_non_pathology_back();
        $mental_healths = UtilsController::get_mental_healths();
        $inmunizations = UtilsController::get_inmunizations();
        $get_condition = UtilsController::get_condition();
        $allergies = UtilsController::get_allergies();
        $allergy_symptoms = UtilsController::get_allergy_symptoms();
        $medical_devices = UtilsController::get_medical_device();
        $medicines_vias = UtilsController::get_medicines_vias();
        $covid_vacunas = VacunaCovid::all();


        return view('livewire.components.clinical-history',
        compact(
            'history',
            'Patient',
            'validateHistory',
            'vital_sing',
            'family_back',
            'pathology_back',
            'non_pathology_back',
            'mental_healths',
            'inmunizations',
            'get_condition',
            'allergies',
            'allergy_symptoms',
            'medical_devices',
            "medicines_vias",
            'covid_vacunas',
        ));

    }
}
