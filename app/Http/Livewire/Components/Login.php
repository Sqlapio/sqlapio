<?php

namespace App\Http\Livewire\Components;

use App\Http\Controllers\ActivityLogController;
use App\Models\User;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Login extends Component
{

    public $show;

    public function render()
    {
        $this->show = true;
        return view('livewire.components.login', ['show' => $this->show]);
    }

    public function rules()
    {
        $rules = [
            'username' => 'required|min:3|max:50',
            'password' => 'required|min:6|max:8|regex:"^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$"',
        ];

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'username.required' => 'Usuario requerido',
            'password.required' => 'Contraseña requerida',
            'username.min' => 'Usuario debe ser mayor a 3 caracteres',
            'username.max' => 'Usuario debe ser menor a 50 caracteres',
            'password.min' => 'Contraseña debe ser mayor a 6 caracteres',
            'password.max' => 'Contraseña debe ser menor a 8 caracteres',
            'password.regex' => 'Formato de contraseña  incorrecto',

        ];
        return $messages;
    }

    public function login(Request $request)
    {

        
        $validator = Validator::make($request->all(), $this->rules(), $this->messages());

        if($validator->fails())
        {

            return Redirect::to('/')->withErrors($validator);

        }else{

            try {
                // Verificamos que el usuario exita en base de datos
                $user = User::where('email', $request->username)->get();
                foreach($user as $item){
                    $pass = $item->password;
                }

                if($user =! null)
                {
                    if (Hash::check($request->password, $pass)){

                        $credenciales = [
                            'email' => $request->username,
                            'password' => $request->password,
                        ];

                        Auth::attempt($credenciales);

                        $action = '1';

                        ActivityLogController::store_log($action);

                        return Redirect::route('DashboardComponent');

                    }

                
                }else{
        
                    return back()->with('error', 'User created successfully.');
                }

            } catch (\Throwable $th) {
                
                Log::error(['exeption in Livewire.Components.Login()', $th]);
            }

        }
    }
}
