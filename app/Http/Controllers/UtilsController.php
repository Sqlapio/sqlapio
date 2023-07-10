<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\City;
use App\Models\DoctorCenter;
use App\Models\History;
use App\Models\Patient;
use App\Models\State;
use Illuminate\Support\Facades\App;
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
		if ($value == '6') {
			return 'patient history register';
		}
		if ($value == '7') {
			return 'appointment register';
		}
		if ($value == '8') {
			return 'interview register';
		}
		if ($value == '9') {
			return 'representative register';
		}
		if ($value == '10') {
			return 'medical association to center';
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
	static function update_registro($id, $request) {
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

	static function get_cities()
	{
		$cities = City::all();
		return $cities;
	}

	static function get_states()
	{
		$states = State::all();
		return $states;
	}

	static function get_patients()
	{
		$patients = Patient::all();
		return $patients;
	}

	static function get_appointments($id)
	{
		$appointments = Appointment::where('user_id', $id)->get();

		if($appointments = ''){
			return '';
		}else{
			return $appointments;
		}
		
	}

	static function get_history($id)
	{
		$history = History::where('id', $id)->get();
		return $history;
	}

	static function get_patients_pag($value)
	{
		$patients_pagination = Patient::all()->paginate($value);
		return $patients_pagination;
	}

	static function get_doctor_centers_pag($value)
	{
		$doctor_centers = DoctorCenter::all()->paginate($value);
		return $doctor_centers;
	}

	static function get_doctor_centers($id)
	{
		$doctor_centers = DoctorCenter::where('id', $id)->get();
		return $doctor_centers;
	}


}
