<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UtilsController extends Controller {
	static function get_action($value) {
		if ($value == '1') {
			return 'login';
		}
		if ($value == '2') {
			return 'logout';
		}
		if ($value == '3') {
			return 'initial registration';
		}
		if ($value == '4') {
			return 'update data';
		}
		if ($value == '5') {
			return 'patient register';
		}
	}

	/**
	 * Funcion que se encargar de actualizar la informacior
	 * personal del usuario (medico).
	 *
	 * NOTA: el parametro $request es la informacion
	 * que viaja desde el formulario de registro.
	 *
	 * @param id
	 * @param array request
	 */
	static public function update_registro($id, $request) {
		try {

			$update = DB::table('users')
				->where('id', $id)
				->update([
					'ci' => $request->ci,
					'birthdate' => $request->birthdate,
					'age' => $request->age,
					'phone' => $request->phone,
					'state' => $request->state,
					'city' => $request->city,
					'address' => $request->address,
					'zip_code' => $request->zip_code,
					'status_register' => '2',
				]);

		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.update_registro()', $message);
		}
	}

}
