<?php

namespace App\Http\Livewire\Components;

use App\Models\ExamPatient;
use App\Models\Patient;
use Illuminate\Http\Request;
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
            $Patient = Patient::where('id', $id)->first();
            $data_exam = ExamPatient::where('patient_id', $id)
                ->where('status', 2)
                ->with('get_laboratory')
                ->get();
            $data = [
                'patient_id' =>  $Patient->id,
                'full_name' => $Patient->name . ' ' . $Patient->last_name,
                'ci' => ($Patient->is_minor == "false") ? $Patient->ci : $Patient->get_reprensetative->re_ci,
                'genero' => $Patient->genere,
                'exam' => $data_exam,
            ];
        }
        dd( $data );
        return view('livewire.components.examen', compact('data', 'id'));
    }
}
