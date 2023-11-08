<?php

namespace App\Http\Livewire\Components;

use App\Http\Controllers\ActivityLogController;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Login extends Component {

	public $show;

	public function rules() {
		$rules = [
			'username' => 'required|min:3|max:50',
			'password' => 'required|min:6',
		];

		return $rules;
	}

	public function messages() {
		$messages = [
			'username.required' => 'Usuario requerido',
			'password.required' => 'Contraseña requerida',
			'username.min' => 'Usuario debe ser mayor a 3 caracteres',
			'username.max' => 'Usuario debe ser menor a 50 caracteres',
			'password.min' => 'Contraseña debe ser mayor a 6 caracteres',
			'password.regex' => 'Formato de contraseña  incorrecto',

		];
		return $messages;
	}

	public function login(Request $request) {

		$validator = Validator::make($request->all(), $this->rules(), $this->messages());

		if ($validator->fails()) {

			return Redirect::to('/')->withErrors($validator);

		} else {

			try {
				// Verificamos que el usuario exita en base de datos
				$user = User::where('email', $request->username)->get();
				foreach ($user as $item) {
					$pass = $item->password;
				}

				if ($user = !null) {
					if (Hash::check($request->password, $pass)) {

						$credenciales = [
							'email' => $request->username,
							'password' => $request->password,
						];

						Auth::attempt($credenciales);
						$request->session()->regenerate();

						$action = '1';
						ActivityLogController::store_log($action);

						$user = Auth::user();
						$status_register = $user->status_register;
						$speciality = Specialty::all();

						// Redireccion segun status de registro
						if ($status_register == '1') {
							return view('livewire.components.profile', compact('user','speciality'));

						} else {

							return Redirect::route('DashboardComponent');
						}
					}

				} else {

					return back()->with('error', 'User created successfully.');
				}

			} catch (\Throwable $th) {
				$message = $th->getMessage();
				return Redirect::to('/')->withErrors('Autenticación incorrecta');
			}
			return Redirect::to('/')->withErrors('Autenticación incorrecta');
		}
	}

	public function logout()
	{
		Session::flush();
        Auth::logout();
        return redirect('/');
	}

	public function render() {

		// dd();
		$this->show = true;
		return view('livewire.components.login', ['show' => $this->show]);
	}
}
