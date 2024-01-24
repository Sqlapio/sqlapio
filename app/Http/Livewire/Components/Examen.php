<?php

namespace App\Http\Livewire\Components;

use App\Models\ExamPatient;
use App\Models\Patient;
use App\Models\StudyPatient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Examen extends Component
{
    public function res_exam(Request $request)
    {
    }


    public function render($id = null)
    {

        $data = [];
        if ($id != null) {
            $data = ExamPatient::where('status', 2)
            ->where('patient_id', $id)
            ->with('get_laboratory')->get(); 
        }else{

            $data = ExamPatient::where('status', 2)
            ->where('user_id', Auth::user()->id)
            ->with('get_laboratory')->get();
        }
        
        return view('livewire.components.examen', compact('data', 'id'));
    }
}
