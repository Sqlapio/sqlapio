<?php

namespace App\Http\Livewire\Components;

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\UtilsController;
use App\Models\Center;
use App\Models\History;
use App\Models\Interview;
use App\Models\Patient;
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
                    'reason_visit.required'     => 'Campo requerido',
                    'physical_exam.required'    => 'Campo requerido',
                    'diagnosis.required'    => 'Campo requerido',
                    'medication.required'   => 'Campo requerido',
                    'image_exam.required'   => 'Campo requerido',
                    'image_other.required'  => 'Campo requerido',
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
                        'cuerpo' => 'Usted acaba de registrar la hsitoria clinica del paciente: ',
                        'name' => $name.' '.$last_name,
                        'name' => $name.' '.$last_name,
                    ];
                    
                    UtilsController::notification_email($doctor_email, $title, $body);
                }
        
                return true;
            
        } catch (\Throwable $th) {
            $message = $th->getMessage();
			dd('Error Livewire.Components.ClinicalHistory.store()', $message);
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
        $get_condition = UtilsController::get_condition();
        return view('livewire.components.clinical-history', 
        compact(
            'history',
            'Patient',
            'validateHistory',
            'vital_sing',
            'family_back',
            'pathology_back',
            'non_pathology_back',
            'get_condition'
        ));

    }
}
