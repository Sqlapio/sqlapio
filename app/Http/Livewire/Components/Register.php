<?php

namespace App\Http\Livewire\Components;

use App\Http\Controllers\ActivityLogController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Register extends Component
{

    public $show;

    public function store(Request $request)
    {
        /**
         * @param name
         * @param lastname
         * @param email
         * @param password
         * 
         * Reglas de validacion + mensajes de validacion.
         * 
         * NOTA: El resto de la informacion del usuario sera cargada desde el modulo de configuracion
         * al completar el registro
         */
        $request->validate([

            'name'      => 'required|min:3|max:50',
            'last_name' => 'required|min:3|max:50',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:6|max:8|regex:"^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$"',
        ],[

            'name'              => 'Campo requerido',
            'lastname'          => 'Campo requerido',
            'email'             => 'Campo requerido',
            'password'          => 'Campo requerido',
            'password.min'      => 'Contraseña debe ser mayor a 6 caracteres',
            'password.max'      => 'Contraseña debe ser menor a 8 caracteres',
            'password.regex'    => 'Formato de contraseña  incorrecto',
        ]);

        try {
                $user = User::create([

                    'name'      => $request->name,
                    'last_name' => $request->last_name, 
                    'email'     => $request->email, 
                    'password'  => Hash::make($request->password),
                    'role'       => $request->rol, 
        
                ]);
        
                $action = '3';

                ActivityLogController::store_log($action);
        
                return back()->with('success', 'El registro inicial satisfactorio');

        } catch (\Throwable $th) {
            Log::info(['exeption in Livewire.Components.Login()', $th]);
        }  

    }


    public function render()
    {
        $this->show = true;
        return view('livewire.components.register',['show' => $this->show]);
    }


}
