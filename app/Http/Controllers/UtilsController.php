<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Models\Appointment;
use App\Models\Center;
use App\Models\City;
use App\Models\DoctorCenter;
use App\Models\History;
use App\Models\Patient;
use App\Models\State;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

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
		try {
			$cities = City::all();
			return $cities;
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_cities()', $message);
		}
		
	}

	static function get_states()
	{
		try {
			$states = State::all();
			return $states;

		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_states()', $message);
		}

	}

	static function get_patients()
	{
		try {
			$patients = Patient::all();
			return $patients;

		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_patients()', $message);
		}
		
	}

	static function get_appointments($id)
	{
		try {
			$appointments = Appointment::where('user_id', $id)->get();

			if($appointments = ''){
				return '';
			}else{
				return $appointments;
			}
			//code...
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_appointments()', $message);
		}
		
	}

	static function get_history($id)
	{
		try {
			$history = History::where('id', $id)->get();
			return $history;
			//code...
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_history()', $message);
		}
		
	}

	static function get_patients_pag($value)
	{
		try {
			$patients_pagination = Patient::all()->paginate($value);
			return $patients_pagination;
			//code...
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_patients_pag()', $message);
		}
		
	}

	static function get_doctor_centers_pag($value)
	{
		try {
			$doctor_centers = DoctorCenter::all()->paginate($value);
			return $doctor_centers;
			//code...
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_doctor_centers_pag()', $message);
		}
		
	}

	static function get_doctor_centers($id)
	{
		try {
			$doctor_centers = DoctorCenter::where('id', $id)->get();
			return $doctor_centers;
			//code...
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_doctor_centers()', $message);
		}
		
	}


	static function get_one_patient($id)
	{
		try {
			$Patient = Patient::where('id', $id)->first();
			return $Patient;
			//code...
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_one_patient()', $message);
		}
		
	}

	static function get_centers()
	{
		try {
			$centers = Center::all();
			return $centers;
			//code...
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_doctor_centers()', $message);
		}
		
	}

	static function send_mail($verification_code, $email)
    {

		try {
			$mailData = [
				'title' => 'Mail de SqlapioTechnology',
				'body' => 'Verificacion de tu cuenta de correo electronico'
			];
			 
			Mail::to($email)->send(new SendMail($mailData, $verification_code));

		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.send_mail()', $message);
		}
        
    }

	static function verify_email($verification_code)
	{

		try {

				$verify = DB::table('users')
					->where('verification_code', $verification_code)
					->update(['email_verified_at' => date('Y-m-d H:m:ss')]);

				return redirect('/login')->with('success', 'Has confirmado correctamente tu correo!');
			//code...
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.verify_email()', $message);
		}
		

	}

}
