<?php

namespace App\Http\Livewire\Components\ProfilePatients;

use App\Http\Controllers\ActivityLogController;
use App\Models\UserPatients;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

use Livewire\Component;
use PhpParser\Node\Stmt\TryCatch;
use SebastianBergmann\Type\FalseType;

class LoginPatient extends Component
{


    public function login(Request $request)
    {

        try {
            $rules = [
                'username' => 'required|min:3|max:50',
                'password' => 'required|min:6',
            ];

            $messages = [
                'username.required' => __('messages.alert.usuario_requerido'),
                'password.required' => __('messages.alert.contraseña_obligatorio'),
                'username.min'      => __('messages.alert.usuario_3_caracteres'),
                'username.max'      => __('messages.alert.usuario_50_caracteres'),
                'password.min'      => __('messages.alert.campo_6_caracteres'),
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'msj'  => $validator->errors()->all()
                ], 400);
            }

            $user_exist = UserPatients::where('username', $request->username)->first();

            if ($user_exist) {

                if (Hash::check($request->password, $user_exist->password)) {

                    $credenciales = [
                        'username' => $request->username,
                        'password' => $request->password,
                    ];

                    Auth::guard('users_patients')->attempt($credenciales);


                    $request->session()->regenerate();

                    return response()->json([
                        'success' => true,
                        'msj'  => __('messages.alert.auntenticacion_corr')
                    ], 200);
                } else { // credenciales incorrectas
                    return response()->json([
                        'success' => false,
                        'msj'  => __('messages.alert.auntenticacion_inc')
                    ], 400);
                }
            } else {
                return response()->json([
                    'success' => false,
                    'msj'  => __('messages.alert.paciente_no_existe')
                ], 400);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'msj'  => __('messages.alert.error_interno')
            ], 500);
        }
    }


    public function logout()
    {
        Session::flush();
        Auth::logout();
        return Redirect::route("query-detaly-patient");
    }

    public function render()
    {
        return view('livewire.components.profile-patients.login-patient');
    }
}
