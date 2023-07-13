<?php

namespace App\Http\Livewire\Components;

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\UtilsController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;

class Register extends Component {

	public $show;

	public function store(Request $request) {
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

			'name' => 'required|min:3|max:50',
			'last_name' => 'required|min:3|max:50',
			'email' => 'required|email|unique:users',
			'password' => 'required|min:6|max:8|regex:"^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$"',
		], [

			'name' => 'Campo requerido',
			'lastname' => 'Campo requerido',
			'email' => 'Campo requerido',
			'email.unique' => 'El email ya se encuentra registrado',
			'password' => 'Campo requerido',
			'password.min' => 'Contraseña debe ser mayor a 6 caracteres',
			'password.max' => 'Contraseña debe ser menor a 8 caracteres',
			'password.regex' => 'Formato de contraseña  incorrecto',
		]);

		try {
			$user = User::create([

				'name' => $request->name,
				'last_name' => $request->last_name,
				'email' => $request->email,
				'password' => Hash::make($request->password),
				'role' => $request->rol,
				'verification_code' => Str::random(30)

			]);

			$action = '3';

			ActivityLogController::store_log($action);

			UtilsController::send_mail($user['verification_code'], $user['email']);

			return redirect('/')->with('success', 'El registro inicial satisfactorio');

		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error Livewire.Components.Register.store()', $message);
		}

	}

	public function update(Request $request) {

		$request->validate([

			'ci' => 'required',
			'birthdate' => 'required',
			'age' => 'required',
			'phone' => 'required',
			'state' => 'required',
			'city' => 'required',
			'address' => 'required',
			'zip_code' => 'required',
		], [

			'ci' => 'Campo requerido',
			'birthdate' => 'Campo requerido',
			'age' => 'Campo requerido',
			'phone' => 'Campo requerido',
			'state' => 'Campo requerido',
			'city' => 'Campo requerido',
			'address' => 'Campo requerido',
			'zip_code' => 'Campo requerido',
		]);

		try {
			// informacion del usuario
			$user = Auth::user();

			UtilsController::update_registro($user->id, $request);

			$action = '4';
			ActivityLogController::store_log($action);

			return true;

		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error Livewire.Components.Register.store()', $message);
		}

	}

	public function render() {
		$this->show = true;
		return view('livewire.components.register', ['show' => $this->show]);
	}

}
