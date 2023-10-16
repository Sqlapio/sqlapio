<?php

namespace App\Http\Livewire\Components;

use App\Models\Patient;
use App\Models\StudyPatient;
use Illuminate\Http\Request;
use Livewire\Component;

class Study extends Component
{
  public function res_study(Request $request)
  {
  }

  public function render($id = null)
  {

    $data= [];
    if ($id != null) {
      $Patient = Patient::where('id', $id)->first();
      $data_study = StudyPatient::where('patient_id', $id)
        ->where('status', 2)
        ->with('get_laboratory')
        ->get();

      $data = [
        'patient_id' =>  $Patient->id,
        'full_name' => $Patient->name . ' ' . $Patient->last_name,
        'ci' => ($Patient->is_minor == "false") ? $Patient->ci : $Patient->get_reprensetative->re_ci,
        'genero' => $Patient->genere,
        'study' => $data_study,
      ];
    }
    
    return view('livewire.components.study', compact('data','id'));
  }
}
