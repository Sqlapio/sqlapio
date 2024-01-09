<?php

namespace App\Http\Livewire\Components\SalesForces;

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\UtilsController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Livewire\Component;

class RegisterUserSalesForces extends Component
{
    public function store(Request $request)
	{

                $rules = [
                    'name'      => 'required',
                    'last_name' => 'required',
                    'password'  => 'required',
                    'email'     => 'required|unique:users',
                    'state'     => 'required|unique:users',

                ];

                $msj = [
                    'name'              => 'Campo requerido',
                    'state'             => 'Campo requerido',
                    'email.required'    => 'Campo requerido',
                    'email.unique'      => 'El email ya se encuentra registrado en la base de datos. Por favor intente con uno diferente',
                    'last_name'         => 'Campo requerido',
                    'password'          => 'Campo requerido',
                    'password.min'      => 'Contraseña debe ser mayor a 6 caracteres',
                    'password.max'      => 'Contraseña debe ser menor a 8 caracteres',
                    'password.regex'    => 'Formato de contraseña  incorrecto',
                ];

                $validator = Validator::make($request->all(), $rules, $msj);

                if ($validator->fails()) {
                    return response()->json([
                        'success' => 'false',
                        'errors'  => $validator->errors()->all()
                    ], 400);
                }

                try {

                    $url_token =($request->role!=="gerente_general")? env('URL_REGISTER_USER_FORCE_SALE').Crypt::encryptString($request->user_id):null;


                    $user_general_manager = new User();
                    $user_general_manager->name = $request->name;
                    $user_general_manager->last_name = $request->last_name;
                    $user_general_manager->email = $request->email;
                    $user_general_manager->password = Hash::make($request->password);
                    $user_general_manager->verification_code = Str::random(30);
                    $user_general_manager->role = $request->role;
                    $user_general_manager->token_corporate = $url_token;
                    $user_general_manager->save();

                    /**
                     * Registro de accion en el log
                     * del sistema
                     */
                    $action = '22';
                    ActivityLogController::store_log($action);

                    /**
                     * Envio de notificacion por correo
                     */
                    $type = 'verify_email_general_manager';
                    $mailData = [
                        'gm_name' => $request->name.' '.$request->last_name,
                        'gm_email' => $request->email,
                        'verify_code' => $user_general_manager->verification_code,
                    ];

                    UtilsController::notification_mail($mailData, $type);

                    return true;

                } catch (\Throwable $th) {
                    $message = $th->getMessage();
                    dd('Error Livewire.Components.GeneralManager.Profile.store()', $message);
                }
	}

    public function render($hash=null)
    {
        return view('livewire.components.sales-forces.register-user-sales-forces',compact('hash'));
    }
}
