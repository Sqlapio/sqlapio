<?php

namespace App\Http\Livewire\Components\ProfileSecretary;

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\UtilsController;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class Registe extends Component
{
    public function render()
    {
        return view('livewire.components.profile-secretary.registe');
    }

    public function store(Request $request)
    {

        try {

            $rules = [
                'name'      => 'required',
                'last_name' => 'required',
                'email'     => 'required|unique:users',
                'password'  => 'required',
                'type_rif'  => 'required',
            ];

            $msj = [
                'name'              => 'Campo requerido',
                'last_name'         => 'Campo requerido',
                'type_rif'         => 'Campo requerido',
                'password'          => 'Campo requerido',
                'password.min'      => 'Contraseña debe ser mayor a 6 caracteres',
                'password.max'      => 'Contraseña debe ser menor a 8 caracteres',
                'email.unique'            => 'El correo electronico ya se encuentra registrado. Por favor intente con uno distinto.'
            ];

            $validator = Validator::make($request->all(), $rules, $msj);

            if ($validator->fails()) {

                return response()->json([
                    'success' => false,
                    'msj'  => $validator->errors()->all()
                ], 400);
            }

            $date_today = Carbon::createFromFormat('Y-m-d', date('Y-m-d'));
            $date_today = $date_today->addDay(30)->format('Y-m-d');
            
            $user = new User();
            $user->name = $request->name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->verification_code = Str::random(30);
            $user->role = 'secretary';
            $user->email_verified_at = $date_today;
            $user->save();

            /**Registro la accion del usuario registrado en el log */
            $action = '3';
            ActivityLogController::store_log($action);

            return response()->json([
                'success' => true,
                'msj'  => __('messages.alert.registro_inicial')
            ], 200);
        } catch (\Throwable $th) {
            $message = $th->getMessage();

            return response()->json([
                'success' => false,
                'msj'  => "Error interno"
            ], 400);
        }
    }

    public function update(Request $request)
    {

        try {
            /** Reglas de validacion para el medico libre */
            $rules = [
                'name'          => 'required',
                'last_name'     => 'required',
                'ci'            => 'required',
                'birthdate'     => 'required',
                'genere'        => 'required',
                'age'           => 'required',
                'phone'         => 'required',
                'state_contrie' => 'required',
                'city_contrie'  => 'required',
                'contrie'       => 'required',
                'address'       => 'required',
                'zip_code'      => 'required',
            ];

            $msj = [
                'name'                    => __('messages.alert.nombre_obligatorio'),
                'last_name'               => __('messages.alert.apellido_obligatorio'),
                'ci'                      => __('messages.alert.cedula_obligatoria'),
                'birthdate'               => __('messages.alert.fecha_obligatorio'),
                'genere'                  => __('messages.alert.genero_obligatorio'),
                'age'                     => __('messages.alert.edad_obligatorio'),
                'phone'                   => __('messages.alert.telefono_obligatorio'),
                'state_contrie'           => __('messages.alert.estado_obligatorio'),
                'city_contrie'            => __('messages.alert.ciudad_obligatorio'),
                'contrie'                 => __('messages.alert.pais_obligatorio'),
                'address'                 => __('messages.alert.direccion_obligatoria'),
                'zip_code'                => __('messages.alert.codigo_obligatorio'),
            ];


            $validator = Validator::make($request->all(), $rules, $msj);

            if ($validator->fails()) {
                return response()->json([
                    'success' => 'false',
                    'errors'  => $validator->errors()->all()
                ], 400);
            }

            // informacion del usuario


            UtilsController::update_registro(auth()->user()->id, $request);

            $action = '4';
            ActivityLogController::store_log($action);

            /**
             * Acumulado para el manejo de estadisticas
             * @param state
             * @param 1 -> menor de edad
             */


            return response()->json([
                'success' => true,
                'msj'  => __('messages.alert.registro_inicial')
            ], 200);
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            dd('Error Livewire.Components.Register.store()', $message);
        }
    }
}
