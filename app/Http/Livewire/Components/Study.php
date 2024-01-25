<?php

namespace App\Http\Livewire\Components;

use App\Models\Patient;
use App\Models\Reference;
use App\Models\StudyPatient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
  
      $data = StudyPatient::where('status', 2)
      ->where('patient_id', $id)
      ->with('get_laboratory')->get(); 

      $estudios_sin_resul = StudyPatient::where('status', 1)
      ->where('patient_id', $id)
      ->with(['get_laboratory', 'get_patient', 'get_reprensetative'])->get();

      $estudios_sin_resul =  Reference::where('patient_id',  $id)            
			->with(['get_patient','get_estudio_stutus_uno','get_reprensetative'])->get();

    }else{

        $data = StudyPatient::where('status', 2)
        ->where('user_id', Auth::user()->id)
        ->with('get_laboratory')->get();       

        $estudios_sin_resul =  Reference::where('user_id',  Auth::user()->id)            
        ->with(['get_patient','get_estudio_stutus_uno','get_reprensetative'])->get();
    }
    
    return view('livewire.components.study', compact('data','estudios_sin_resul','id'));
  }
}
