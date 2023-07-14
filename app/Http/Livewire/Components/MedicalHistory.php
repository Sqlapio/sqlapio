<?php

namespace App\Http\Livewire\Components;

use App\Http\Controllers\ActivityLogController;
use App\Models\History;
use App\Models\Patient;
use Illuminate\Http\Request;
use Livewire\Component;

class MedicalHistory extends Component
{

    /**
     * store history
     */
    public function store(Request $request)
    {
        try {

            $patient = Patient::where('id',$request->id)->get();
            
            foreach($patient as $item)
            {
                $patient_id = $item->id;
                if($item->ci == null){
                    // Paciente menor de edad
                    $cod_patient = $item->re_ci;
                }else{
                    $cod_patient = $item->ci;
                }      
            }

            $history = new History();
            $history->cod_history   = date('dmY').'-'.$cod_patient;
            $history->patient_id    = $patient_id;
            $history->cod_patient   = $cod_patient;
            $history->history_date  = date('d-m-Y');
            $history->weight = $request->weight;
            $history->height = $request->height;
            $history->reason = $request->reason;
            $history->current_illness = $request->current_illness;
            $history->strain = $request->strain;
            $history->temperature = $request->temperature;
            $history->breaths = $request->breaths;
            $history->pulse = $request->pulse;
            $history->saturation = $request->saturation;
            $history->condition = $request->condition;
            $history->applied_studies = $request->applied_studies;
            $history->info_add  = json_encode($request->info_add);
            $history->history_vital_signs    = json_encode($request->history_vital_signs);
            $history->back_family  = json_encode($request->back_family);
            $history->allergies    = json_encode($request->allergies);
            $history->history_non_pathological  = json_encode($request->history_non_pathological);
            $history->history_pathological      = json_encode($request->history_pathological);
            $history->history_surgical          = json_encode($request->history_surgical);
            $history->history_gynecological     = json_encode($request->history_gynecological);
            $history->medications_supplements   = json_encode($request->medications_supplements);
            $history->save();

            $action = '6';
            ActivityLogController::store_log($action);
    
            return true;

        } catch (\Throwable $th) {
            $message = $th->getMessage();
			dd('Error Livewire.Components.MedicalHistory.store()', $message);
        }
    }
    
    public function render()
    {
        return view('livewire.components.medical-history');
    }
}
