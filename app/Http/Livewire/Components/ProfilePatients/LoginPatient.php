<?php

namespace App\Http\Livewire\Components\ProfilePatients;

use App\Http\Controllers\ActivityLogController;
use App\Models\UserPatients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Livewire\Component;
use SebastianBergmann\Type\FalseType;

class LoginPatient extends Component
{


    public function login(Request $request)
    {
        $rules = [
            'username' => 'required|min:3|max:50',
            'password' => 'required|min:6',
        ];

        $messages = [
            'username.required' => __('messages.alert.usuario_requerido'),
            'password.required' => __('messages.alert.contraseña_obligatorio'),
            'username.min'      => __('messages.alert.usuario_3_caracteres'),
            'username.max'      =>  __('messages.alert.usuario_50_caracteres'),
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
                    'msj'  => "autenticacoIn correcta"
                ], 200);
            } else { // credenciales incorrectas
                return response()->json([
                    'success' => false,
                    'msj'  => "autenticacoIn incorrecta"
                ], 400);
            }
        } else {
            return response()->json([
                'success' => false,
                'msj'  => "usuario no exitesa"
            ], 400);
        }
    }

    public function render()
    {
        return view('livewire.components.profile-patients.login-patient');
    }
}
