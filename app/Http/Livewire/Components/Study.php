<?php

namespace App\Http\Livewire\Components;

use App\Models\Patient;
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

    }else{    
        
      $data = StudyPatient::where('status', 2)
      ->where('user_id', Auth::user()->id)
      ->with('get_laboratory')->get();
    }
    
    return view('livewire.components.study', compact('data','id'));
  }
}
