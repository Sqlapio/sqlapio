<?php

namespace App\Http\Livewire\Components;

use App\Models\ExamPatient;
use App\Models\Patient;
use App\Models\Reference;
use App\Models\StudyPatient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Examen extends Component
{
    public function res_exam(Request $request)
    {
        // dd(Request()->all());

        // Page Length
        $pageNumber = ($request->start / $request->length) + 1;
        $pageLength = $request->length;
        $skip       = ($pageNumber - 1) * $pageLength;

        Log::info("pageNumber"."---------->".$pageNumber);
        Log::info("pageLength"."---------->".$pageLength);
        Log::info("skip"."---------->".$skip);

        $count = ExamPatient::where('status', 2)
        ->where('user_id', Auth::user()->id)->get();   

        $data = ExamPatient::where('status', 2)
        ->where('user_id', Auth::user()->id)      
        ->limit($pageLength)
        ->offset($pageNumber)
        ->with(['get_laboratory', 'get_patients', 'get_reprensetative'])->get(); 

        $res = [
            "data" => $data,
            "count" => count( $count),
            "limit" => $pageLength,
            "offset" => $pageNumber,
        ];
        
        return $res ;
    }


    public function render($id = null)
    {

        $data = [];
        if ($id != null) {
            $data = ExamPatient::where('status', 2)
                ->where('patient_id', $id)
                ->with('get_laboratory')->get();

            $examen_sin_resul =  Reference::where('patient_id',  $id)
                ->with(['get_patient', 'get_examne_stutus_uno', 'get_reprensetative'])->get();
        } else {

            $data = ExamPatient::where('status', 2)
                ->where('user_id', Auth::user()->id)
                ->with('get_laboratory')->get();

            $examen_sin_resul =  Reference::where('user_id',  Auth::user()->id)
                ->with(['get_patient', 'get_examne_stutus_uno', 'get_reprensetative'])->get();
        }
        return view('livewire.components.examen', compact('data', 'examen_sin_resul', 'id'));
    }
}
