<?php

namespace App\Http\Livewire\Components;

use App\Http\Controllers\ActivityLogController;
use App\Models\Specialty;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Login extends Component
{

	public $show;

	public function rules()
	{
		$rules = [
			'username' => 'required|min:3|max:50',
			'password' => 'required|min:6',
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
			'password.regex' => 'Formato de contraseña  incorrecto',

		];
		return $messages;
	}

	public function login(Request $request)
	{

		$validator = Validator::make($request->all(), $this->rules(), $this->messages());

		if ($validator->fails()) {

			return Redirect::to('/')->withErrors($validator);
		} else {

			try {
				$user_exist = User::where('email', $request->username)->first();
				// Verificamos que el usuario exita en base de datos
				if ($user_exist != null) {
					// Verificamos status del usuriao habilitadoi
					if ($user_exist->tipo_status == '1') {
						if (Hash::check($request->password, $user_exist->password)) {

							$credenciales = [
								'email' => $request->username,
								'password' => $request->password,
							];

							Auth::attempt($credenciales);
							$request->session()->regenerate();

							$action = '1';
							ActivityLogController::store_log($action);

							$user = Auth::user();

							// verificar si vlaido el correo
							if ($user->email_verified_at === null) {
								return Redirect::to('/')->withErrors('Debe verificar su correo electronico!');
							}

							$status_register = $user->status_register;
							$speciality = Specialty::all();

							// Redireccion segun status de registro	y rol					
							switch ($user->role) {
								case 'corporativo':
									if ($status_register == 1) {
										// return view('livewire.components.profile', compact('user', 'speciality'));
										return Redirect::route('Profile');
									} else {
										return Redirect::route('Dashboard-corporate');
									}
									break;
								case 'gerente_general':
									if ($status_register == 1) {
										return Redirect::route('profile-user-force-sale');
									} else {
										return Redirect::route('dashboard-general-manager');
									}
									break;
								case 'gerente_zone':
									if ($status_register == 1) {
										return Redirect::route('profile-user-force-sale');
									} else {
										return Redirect::route('dashboard-general-zone');
									}
									break;
								default:
									if ($status_register == 1) {
										return Redirect::route('Profile');
									} else {
										return Redirect::route('DashboardComponent');
									}
									break;
							}
							/////////END///////////////////
						} else { // credenciales incorrectas
							return Redirect::to('/')->withErrors('Autenticación incorrecta');
						}
					} else { // usuario desahabilitado
						return Redirect::to('/')->withErrors('El usuario no existe o se encuentra deshabilitado. Por favor valide la información y vuelva a intentarlo');
					}
				} else {//no exite usuario
					return Redirect::to('/')->withErrors('Autenticación incorrecta');
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

	public function render()
	{

		// dd();
		$this->show = true;
		return view('livewire.components.login', ['show' => $this->show]);
	}
}
