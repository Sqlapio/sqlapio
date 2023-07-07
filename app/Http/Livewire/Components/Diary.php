<?php

namespace App\Http\Livewire\Components;

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\UtilsController;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Diary extends Component
{

    public function store(Request $request)
    {
        try {

            $this->validate([
                'user_id'       => 'required',
                'patient_id'    => 'required',
                'center_id'     => 'required',
                'date_start'    => 'required',
                'hour_start'    => 'required',
                'hour_end'      => 'required',
                'type_appointments'     => 'required',
                'place_appointments'    => 'required',
    
            ],[
                'user_id.required'       => 'Campo requerido',
                'patient_id.required'    => 'Campo requerido',
                'center_id.required'     => 'Campo requerido',
                'date_start.required'    => 'Campo requerido',
                'hour_start.required'    => 'Campo requerido',
                'hour_end.required'      => 'Campo requerido',
                'type_appointments.required'     => 'Campo requerido',
                'place_appointments.required'    => 'Campo requerido',
    
            ]);
    
            Appointment::create($request->all());
    
            $action = '7';
            ActivityLogController::store_log($action);
    
            return true;
            
        } catch (\Throwable $th) {
            $message = $th->getMessage();
			dd('Error Livewire.Components.Diary.store()', $message);
        }  
        
    }
    public function render()
    {
        $appointments = UtilsController::get_appointments(Auth::user()->id);

        return view('livewire.components.diary', compact('appointments'));
    }
}
