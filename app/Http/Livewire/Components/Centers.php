<?php

namespace App\Http\Livewire\Components;

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\UtilsController;
use App\Models\DoctorCenter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Centers extends Component
{
    public $listUser;

    public function store(Request $request)
    {
        try {

            $user = Auth::user()->id;
            $request->validate([
    
                'address' => 'required',
                'number_floor' => 'required|numeric',
                'number_consulting_room' => 'required|numeric',
                'phone_consulting_room' => 'required|numeric',
            ], [
    
                'name.required' => 'Campo requerido',
                'number_floor.required' => 'Campo requerido',
                'number_consulting_room.required' => 'Campo requerido',
                'phone_consulting_room.required' => 'Campo requerido',
                'number_floor.numeric' => 'El valor debe ser numerico',
                'number_consulting_room.numeric' => 'El valor debe ser numerico',
                'phone_consulting_room.numeric' => 'El valor debe ser numerico',
            ]);
    
            $doctor_centers = new DoctorCenter();
            $doctor_centers->address = $request->address;
            $doctor_centers->number_floor = $request->number_floor;
            $doctor_centers->number_consulting_room = $request->number_consulting_room;
            $doctor_centers->phone_consulting_room = $request->phone_consulting_room;
            $doctor_centers->user_id = $user;
            $doctor_centers->center_id = $request->center_id;
    
            $action = '10';
                
            ActivityLogController::store_log($action);
    
            return true;

        } catch (\Throwable $th) {
            $message = $th->getMessage();
			dd('Error Livewire.Components.Centers.store()', $message);
        }

    }

    public function render()
    {

        $this->listUser = [
            0 => [
                "hr" => "10:15 am",
                "patient" => "kleyner Villegas",
                "aseguradora" => "Matrix",
                "typeVisit" => "Emergencia",
                "status" => "Activo",
                "phone" => "04242231238",
                "contact" => "",
                "lastVisit" => "13-05-2023",
                "action" => "Clinica",
            ],
            1 => [
                "hr" => "11:15 am",
                "patient" => "Diego Villegas",
                "aseguradora" => "Cualita",
                "typeVisit" => "Control",
                "status" => "Inactivo",
                "phone" => "04242231238",
                "contact" => "",
                "lastVisit" => "14-05-2023",
                "action" => "Clinica",
            ]           
       ];

       $user_id = Auth::user()->id;
       $doctor_centers = UtilsController::get_doctor_centers($user_id);

        return view('livewire.components.centers', ['listUser' => $this->listUser]);
    }
}
