<?php

namespace App\Http\Livewire\Components;

use App\Http\Controllers\ActivityLogController;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Patients extends Component
{

    public function store(Request $request)
    {
        /**
         * @param Request
         * @var $request
         * 
         * Reglas de validacion + mensajes de validacion.
         */
        $validate_data = $request->validate([

            'name'          => 'required|min:3|max:50',
            'last_name'     => 'required|min:3|max:50',
            'ci'            => 'required|min:5|max:8',
            'email'         => 'required|email|unique:users',
            'genere'        => 'required',
            'birthdate'     => 'required',
            'age'           => 'required|min:1|max:3',
            'state'        => 'required',
            'city'          => 'required',
            'address'       => 'required',
            'zip_code'      => 'required',
            'pathologies'   => 'required',
            
        ],[

            'name'         => 'Campo requerido',
            'name.min'     => 'Cantidad invalida de caracteres. Debe ser mayor de 3 caracteres',
            'name.max'     => 'Cantidad invalida de caracteres. Debe ser menor de 50 caracteres',

            'last_name'     => 'Campo requerido',

            'ci'           => 'Campo requerido',
            'ci.min'       => 'Su cedula debe ser mayor a 5 caracteres',
            'ci.max'       => 'Su cedula invalida.',

            'email'        => 'Campo requerido',
            'genere'       => 'Campo requerido',
            'birthdate'    => 'Campo requerido',

            'age'          => 'Campo requerido',
            'age.min'      => 'Su edad debe ser un numero valido',
            'age.max'      => 'Su edad es incorrecta',

            'estate'       => 'Campo requerido',
            'city'         => 'Campo requerido',
            'address'      => 'Campo requerido',
            'zip_code'     => 'Campo requerido',
            'pathologies'  => 'Campo requerido',

        ]);

        try {

                $patient = new User();
                $patient->name = $request->name;
                $patient->last_name = $request->last_name;
                $patient->ci = $request->ci;
                $patient->email = $request->email;
                $patient->genere = $request->genere;
                $patient->birthdate = $request->birthdate;
                $patient->age = $request->age;
                $patient->state = $request->state;
                $patient->city = $request->city;
                $patient->address = $request->address;
                $patient->zip_code = $request->zip_code;
                $patient->pathologies = json_encode($request->pathologies);
                $patient->password = "N/A";
                $patient->role= "paciente";
                $patient->save();

                $action = '5';
                ActivityLogController::store_log($action);
        
                return true;

        } catch (\Throwable $th) {
            Log::info(['exeption in Livewire.Components.Patient.store()', $th]);
        }  

    }
    public function render()
    {
        return view('livewire.components.patients');
    }
}
