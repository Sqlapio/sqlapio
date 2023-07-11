<?php

namespace App\Http\Livewire\Components;

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\UtilsController;
use App\Models\Patient;
use App\Models\Representative;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Patients extends Component
{

    public function store(Request $request)
    {
        $user_id = Auth::user()->id;

        try {
            if ($request->is_minor == "true") {
                $validate_data = $request->validate(
                    [
    
                        'name'          => 'required|min:3|max:50',
                        'last_name'     => 'required|min:3|max:50',
                        're_name'       => 'required|min:3|max:50',
                        're_last_name'  => 'required|min:3|max:50',
                        're_email'      => 'required|email|unique:patients',
                        're_ci'         => 'required',
                        're_phone'      => 'required',
                        'birthdate'     => 'required',
                        'age'           => 'required|min:1|max:3',
                        'genere'        => 'required',
                        'state'         => 'required',
                        'city'          => 'required',
                        'address'       => 'required',
                        'zip_code'      => 'required',
    
                    ],
                    [
    
                        'name'            => 'Campo requerido',
                        're_name'         => 'Campo requerido',
                        'name.min'        => 'Cantidad invalida de caracteres. Debe ser mayor de 3 caracteres',
                        'name.max'        => 'Cantidad invalida de caracteres. Debe ser menor de 50 caracteres',
                        're_name.min'     => 'Cantidad invalida de caracteres. Debe ser mayor de 3 caracteres',
                        're_name.max'     => 'Cantidad invalida de caracteres. Debe ser menor de 50 caracteres',
                        'last_name'       => 'Campo requerido',
                        're_last_name'    => 'Campo requerido',
                        're_ci'           => 'Campo requerido',
                        're_ci.min'       => 'Su cedula debe ser mayor a 5 caracteres',
                        're_ci.max'       => 'Su cedula invalida.',
                        're_email'        => 'Campo requerido',
                        're_email.unique' => 'El correo ya se encuentra registrado en el sistema',
                        'genere'          => 'Campo requerido',
                        'birthdate'       => 'Campo requerido',
                        'age'             => 'Campo requerido',
                        'age.min'         => 'Su edad debe ser un numero valido',
                        'age.max'         => 'Su edad es incorrecta',
                        'estate'          => 'Campo requerido',
                        'city'            => 'Campo requerido',
                        'address'         => 'Campo requerido',
                        'zip_code'        => 'Campo requerido',
    
                    ]
                );

                // Guardamos la informacion del paciente menor de edad
                $patient = new Patient();
                $patient->name = $request->name;
                $patient->last_name = $request->last_name;
                $patient->genere = $request->genere;
                $patient->birthdate = $request->birthdate;
                $patient->is_minor = 'true';
                $patient->age = $request->age;
                $patient->state = $request->state;
                $patient->city = $request->city;
                $patient->address = $request->address;
                $patient->zip_code = $request->zip_code;
                $patient->user_id = $user_id;
                $patient->center_id = $request->center_id;
                $patient->save();

                /**
                 * Buscamos el ultimo paciente registrado por el medico
                 * @return $id
                 */
                $patient_id = Patient::where('user_id', $user_id)->get()->last()->id;
    
                $re_patient = new Representative();
                $re_patient->re_name = $request->re_name;
                $re_patient->re_last_name = $request->re_last_name;
                $re_patient->re_ci = $request->re_ci;
                $re_patient->re_email = $request->re_email;
                $re_patient->re_phone = $request->re_phone;
                $re_patient->patient_id = $patient_id;
                $re_patient->save();

                $action = '9';
                ActivityLogController::store_log($action);
    
            } else {
                $validate_data = $request->validate(
                    [
    
                        'name'          => 'required|min:3|max:50',
                        'last_name'     => 'required|min:3|max:50',
                        'ci'            => 'required|min:5|max:8',
                        'email'         => 'required|email|unique:patients',
                        'phone'         => 'required',
                        'profession'    => 'required',
                        'genere'        => 'required',
                        'birthdate'     => 'required',
                        'age'           => 'required|min:1|max:3',
                        'state'         => 'required',
                        'city'          => 'required',
                        'address'       => 'required',
                        'zip_code'      => 'required',
    
                    ],
                    [
    
                        'name'         => 'Campo requerido',
                        'name.min'     => 'Cantidad invalida de caracteres. Debe ser mayor de 3 caracteres',
                        'name.max'     => 'Cantidad invalida de caracteres. Debe ser menor de 50 caracteres',
                        'last_name'    => 'Campo requerido',
                        'ci'           => 'Campo requerido',
                        'ci.min'       => 'Su cedula debe ser mayor a 5 caracteres',
                        'ci.max'       => 'Su cedula invalida.',
                        'email'        => 'Campo requerido',
                        'email.unique' => 'El correo ya se encuentra registrado en el sistema',
                        'profession'   => 'Campo requerido',
                        'genere'       => 'Campo requerido',
                        'birthdate'    => 'Campo requerido',
                        'age'          => 'Campo requerido',
                        'age.min'      => 'Su edad debe ser un numero valido',
                        'age.max'      => 'Su edad es incorrecta',
                        'estate'       => 'Campo requerido',
                        'city'         => 'Campo requerido',
                        'address'      => 'Campo requerido',
                        'zip_code'     => 'Campo requerido',
    
                    ]
                );
    
                $patient = new Patient();
                $patient->name = $request->name;
                $patient->last_name = $request->last_name;
                $patient->ci = $request->ci;
                $patient->email = $request->email;
                $patient->phone = $request->phone;
                $patient->profession = $request->profession;
                $patient->genere = $request->genere;
                $patient->birthdate = $request->birthdate;
                $patient->age = $request->age;
                $patient->state = $request->state;
                $patient->city = $request->city;
                $patient->address = $request->address;
                $patient->zip_code = $request->zip_code;
                $patient->user_id = $request->user_id;
                $patient->center_id = $request->center_id;
                $patient->save();

            }

            $action = '5';
            ActivityLogController::store_log($action);

            return true;
            
        } catch (\Throwable $th) {
            $message = $th->getMessage();
			dd('Error Livewire.Components.Patient.store()', $message);
        }

    }
    public function render()
    {
        $patients = UtilsController::get_patients();
        $cities = UtilsController::get_cities();
        $states = UtilsController::get_states();
        $centers = UtilsController::get_centers();
    
        return view('livewire.components.patients', compact('patients', 'cities', 'states', 'centers'));
    }
}
