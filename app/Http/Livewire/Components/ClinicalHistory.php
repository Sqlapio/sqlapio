<?php

namespace App\Http\Livewire\Components;

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\UtilsController;
use App\Models\Interview;
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
        
                return true;
            
        } catch (\Throwable $th) {
            $message = $th->getMessage();
			dd('Error Livewire.Components.ClinicalHistory.store()', $message);
        }
        
    }

    public function render(Request $request)
    {
        $history = UtilsController::get_history($request->patient_id);

        return view('livewire.components.clinical-history', compact('history'));

    }
}
