<?php

namespace App\Http\Controllers;

use App\Http\Livewire\Components\Laboratory as ComponentsLaboratory;
use App\Http\Livewire\Components\Patients;
use App\Mail\NotificationDairy;
use App\Mail\NotificationEmail;
use App\Mail\NotificationPatient;
use App\Mail\NotificationReferences;
use App\Mail\SendMail;
use App\Models\AiContainer;
use App\Models\Appointment;
use App\Models\Center;
use App\Models\City;
use App\Models\Condition;
use App\Models\DoctorCenter;
use App\Models\Exam;
use App\Models\ExamPatient;
use App\Models\FamilyBackground;
use App\Models\History;
use App\Models\Laboratory;
use App\Models\Patient;
use App\Models\State;
use App\Models\MedicalRecord;
use App\Models\MedicalReport;
use App\Models\NonPathologicalBackground;
use App\Models\PathologicalBackground;
use App\Models\Reference;
use App\Models\Representative;
use App\Models\Specialty;
use App\Models\Study;
use App\Models\StudyPatient;
use App\Models\Token;
use App\Models\User;
use App\Models\VitalSign;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Log;
use Mews\Captcha\Facades\Captcha;
use Svg\CssLength;
use Illuminate\Support\Facades\Validator;


class UtilsController extends Controller
{

	static function get_action($value)
	{
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
		if ($value == '11') {
			return 'medical record register';
		}
		if ($value == '12') {
			return 'cancelled appointment';
		}
		if ($value == '13') {
			return 'initial laboratory registration';
		}
		if ($value == '14') {
			return 'update appointment';
		}
		if ($value == '15') {
			return 'reference generate';
		}
		if ($value == '16') {
			return 'initial registration laboratory';
		}
		if ($value == '17') {
			return 'update data of laboratory';
		}
		if ($value == '18') {
			return 'update email';
		}
		if ($value == '19') {
			return 'confirmation email';
		}
		if ($value == '20') {
			return 'update email address';
		}
		if ($value == '21') {
			return 'password reset';
		}
		if ($value == '22') {
			return 'initial registration of General Manager';
		}
		if ($value == '23') {
			return 'dairy: pre-registration of patient';
		}
		if ($value == '24') {
			return 'add physical exams';
		}
        if ($value == '25') {
			return 'add user to STRIPE';
		}
        if ($value == '26') {
			return 'add payment method STRIPE';
		}
        if ($value == '27') {
			return 'get default payment method STRIPE';
		}
        if ($value == '28') {
			return 'delete payment method STRIPE';
		}
        if ($value == '29') {
			return 'change default payment method STRIPE';
		}
        if ($value == '30') {
			return 'new subcription STRIPE';
		}
        if ($value == '31') {
			return 'cancel subcription STRIPE';
		}
        if ($value == '32') {
			return 'change subcription STRIPE';
		}
        if ($value == '33') {
			return 'new subcription STRIPE';
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
	static function update_registro($id, $request)
	{
		try {

			if (Str::contains($request->img, 'base64')) {
				$file =  $request->img;
				if ($file != null) {
					$png = strstr($file, 'data:image/png;base64');
					$jpg = strstr($file, 'data:image/jpg;base64');
					$jpeg = strstr($file, 'data:image/jpeg;base64');
					if ($png != null) {
						$file = str_replace("data:image/png;base64,", "", $file);
						$file = base64_decode($file);
						$extension = ".png";
					} elseif ($jpeg != null) {
						$file = str_replace("data:image/jpeg;base64,", "", $file);
						$file = base64_decode($file);
						$extension = ".jpeg";
					} elseif ($jpg != null) {
						$file = str_replace("data:image/jpg;base64,", "", $file);
						$file = base64_decode($file);
						$extension = ".jpg";
					}
					$nameFile = uniqid() . $extension;

					file_put_contents(public_path('imgs/') . $nameFile, $file);
				}
			} else {
				$nameFile = $request->img;
			}
			$specialty =  $request->specialty;

			if ($request->specialty_new != null) {

				$specialty_new = Specialty::create(['description' => $request->specialty_new]);

				$specialty =  $specialty_new->description;
			}

			$update = DB::table('users')
				->where('id', $id)
				->update([
					'name' 		=> $request->name,
					'last_name' => $request->last_name,
					'ci' 		=> $request->ci,
					'birthdate' => $request->birthdate,
					'genere'    => $request->genere,
					'specialty' => $specialty,
					'age' 		=> $request->age,
					'phone' 	=> $request->phonenumber_prefix . "-" . $request->phone,
					'state' 	=> $request->state_contrie,
					'city' 		=> $request->city_contrie,
					'contrie' 		=> $request->contrie,
					'address' 	=> $request->address,
					'zip_code' 	=> $request->zip_code,
					'cod_mpps' 	=> $request->cod_mpps,
					'number_floor' 	=> $request->number_floor,
					'number_consulting_room' 	=> $request->number_consulting_room,
					'number_consulting_phone' 	=> $request->number_consulting_phone,
					'user_img' 	=> $nameFile,
					'status_register' => '2',
				]);
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.update_registro()', $message);
		}
	}

	static function update_registro_laboratory($id, $request)
	{
		try {

			/**
			 * Funcion para cargar la imagen del medico
			 * cuando actualiza sus datos
			 */

			$nameFile = null;

			$file =  $request->img;
			if ($file != null) {
				$png = strstr($file, 'data:image/png;base64');
				$jpg = strstr($file, 'data:image/jpg;base64');
				$jpeg = strstr($file, 'data:image/jpeg;base64');
				if ($png != null) {
					$file = str_replace("data:image/png;base64,", "", $file);
					$file = base64_decode($file);
					$extension = ".png";
				} elseif ($jpeg != null) {
					$file = str_replace("data:image/jpeg;base64,", "", $file);
					$file = base64_decode($file);
					$extension = ".jpeg";
				} elseif ($jpg != null) {
					$file = str_replace("data:image/jpg;base64,", "", $file);
					$file = base64_decode($file);
					$extension = ".jpg";
				}
				$nameFile = uniqid() . $extension;

				file_put_contents(public_path('imgs/') . $nameFile, $file);
			}

			$update = DB::table('laboratories')
				->where('id', $id)
				->update([
					'rif' => $request->rif,
					'state' => $request->state,
					'city' => $request->city,
					'address' => $request->address,
					'phone_1' => $request->phone_1,
					'phone_2' => $request->phone_2,
					'lab_img' => $nameFile,
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
			$patients = Patient::where("contrie_doc", auth()->user()->contrie)->get();
			return $patients;
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_patients()', $message);
		}
	}

	static function get_appointments($id)
	{
		try {
			$appointments = Appointment::where('user_id', $id)
				->WhereBetween('status', [1, 2])->get();
			$data = [];
			foreach ($appointments as $key => $val) {
				$data[$key] = [
					'id' => $val->id,
					'title' => substr($val->hour_start, 6) . " - " . $val->get_patients->name . " " . $val->get_patients->last_name,
					'start' => date("Y-m-d", strtotime($val->date_start)) . " " . substr($val->hour_start, 0, -9),
					'end' =>  date("Y-m-d", strtotime($val->date_start)) . " " . substr($val->hour_start, 6, -3),
					'rendering' => 'background',
					'color' => $val->color,
					'extendedProps' => [
						'id' =>  $val->id,
						'price' => $val->price,
						'confirmation' => $val->confirmation,
						'phone' => $val->get_patients->is_minor == "true" ? $val->get_patients->get_reprensetative->re_phone . '  (Rep)' : $val->get_patients->phone,
						'name' => $val->get_patients->name,
						'last_name' => $val->get_patients->last_name,
						'ci' => $val->get_patients->is_minor == "true" ? $val->get_patients->get_reprensetative->re_ci . '  (Rep)' : $val->get_patients->ci,
						'email' => $val->get_patients->is_minor == "true" ? $val->get_patients->get_reprensetative->re_email . '  (Rep)' : $val->get_patients->email,
						'genere' => $val->get_patients->genere,
						'age' =>  $val->get_patients->age,
						'patient_id' =>  $val->get_patients->id,
						'center_id' =>  $val->center_id,
						'center' =>  $val->get_center->description,
						'data' => substr($val->hour_start, 0, -3),
						'img' => $val->get_patients->patient_img,
						'data_app' => $val->date_start,
						'time_zone_start' => substr($val->hour_start, 12),
					],
				];
			}
			return $data;
			//code...
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_appointments()', $message);
		}
	}

	static function get_appointments_dashboard($id)
	{
		try {
			$appointments = Appointment::where('user_id', $id)
				->where('date_start', date('Y-m-d'))->get();
			$data = [];
			foreach ($appointments as $key => $val) {
				$data[$key] = [
					'id' => $val->id,
					'title' => substr($val->hour_start, 6) . " - " . $val->get_patients->name . " " . $val->get_patients->last_name,
                    'start' => date("Y-m-d", strtotime($val->date_start)) . " " . substr($val->hour_start, 0, -9),
					'end' =>  date("Y-m-d", strtotime($val->date_start)) . " " . substr($val->hour_start, 6, -3),
					'rendering' => 'background',
					'color' => $val->color,
					'extendedProps' => [
						'id' =>  $val->id,
						'price' => $val->price,
						'confirmation' => $val->confirmation,
						'phone' => $val->get_patients->is_minor == "true" ? $val->get_patients->get_reprensetative->re_phone . '  (Rep)' : $val->get_patients->phone,
						'name' => $val->get_patients->name,
						'last_name' => $val->get_patients->last_name,
						'ci' => $val->get_patients->is_minor == "true" ? $val->get_patients->get_reprensetative->re_ci . '  (Rep)' : $val->get_patients->ci,
						'email' => $val->get_patients->is_minor == "true" ? $val->get_patients->get_reprensetative->re_email . '  (Rep)' : $val->get_patients->email,
						'genere' => $val->get_patients->genere,
						'age' =>  $val->get_patients->age,
						'patient_id' =>  $val->get_patients->id,
						'center_id' =>  $val->center_id,
						'center' =>  $val->get_center->description,
						'data' => substr($val->hour_start, 0, -3),
						'img' => $val->get_patients->patient_img,
						'data_app' => $val->date_start,
						'time_zone_start' => substr($val->hour_start, 12),
						'status' => $val->get_status->description,
						'status_class' => $val->get_status->class,
					],
				];
			}
			return $data;
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

	static function get_patients_pag()
	{
		try {
			$patients = [];
			$patients_pagination = MedicalRecord::all()->unique('patient_id');
			foreach ($patients_pagination as $key => $val) {
				$patients[$key] = [
					'id' 			=> $val->get_patient->id,
					'name' 			=> $val->get_patient->name . ' ' . $val->get_patient->last_name,
					// 'last_name' 	=> $val->get_patient->last_name,
					'patient_code' 	=> $val->get_patient->patient_code,
					'ci' 			=> $val->get_patient->ci,
					'ci_table' 		=> ($val->get_patient->is_minor == "true") ? $val->get_patient->get_reprensetative->re_ci . '  (Rep)' : $val->get_patient->ci,
					'birthdate' 	=> $val->get_patient->birthdate,
					'genere' 		=> $val->get_patient->genere,
					'phone_table' 	=> ($val->get_patient->is_minor === 'true') ? $val->get_patient->get_reprensetative->re_phone . '  (Rep)' : $val->get_patient->phone,
					'phone' 		=> $val->get_patient->phone,
					'email_table' 	=> ($val->get_patient->is_minor === 'true') ? $val->get_patient->get_reprensetative->re_email . '  (Rep)' : $val->get_patient->email,
					'email' 		=> $val->get_patient->email,
					'address' 		=> $val->get_patient->address,
					'patient_img' 	=> $val->get_patient->patient_img,
					'is_minor'		=> $val->get_patient->is_minor,
					'state'			=> $val->get_patient->state,
					'city'			=> $val->get_patient->city,
					'profession'	=> $val->get_patient->profession,
					'center_id' 	=> $val->get_patient->center_id,
					'zip_code' 		=>  $val->get_patient->zip_code,
					'get_reprensetative' => $val->get_patient->get_reprensetative,
				];
			}
			return $patients;
			//code...
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_patients_pag()', $message);
		}
	}

	static function get_doctor_centers_pag()
	{
		try {
			$doctor_centers = DoctorCenter::all();
			return $doctor_centers;
			//code...
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_doctor_centers_pag()', $message);
		}
	}

	static function get_medical_record()
	{
		try {
			$MedicalRecord = MedicalRecord::where('user_id', Auth::user()->id)->get();
			return $MedicalRecord;
			//code...
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_doctor_centers_pag()', $message);
		}
	}

	static function get_medical_record_user($id)
	{
		try {
			$medical_record_user = [];
			$medical_user = MedicalRecord::where('patient_id', $id)->get();
			foreach ($medical_user as $key => $val) {
				$medical_record_user[$key] = [
					'id' 			=>  $val->id,
					'date' 			=> $val->record_date,
					'name_patient' 	=>  $val->get_paciente->name . " " . $val->get_paciente->last_name,
					'full_name_doc' 	=>  $val->get_doctor->name . " " . $val->get_doctor->last_name,
					'center' 		=>  $val->get_center->description,
					'genere' 		=>  $val->get_paciente->genere,
					'patient_id' 		=>  $val->get_paciente->id,
					'data' => [
						'center_id' =>  $val->get_center->id,
						'record_code' 	=>  $val->record_code,
						'cod_ref' 	=>  $val->get_reference->cod_ref,
						'record_type' 	=>  $val->record_type,
						'background' 	=>  $val->background,
						'razon' 		=>  $val->razon,
						'diagnosis' 	=>  $val->diagnosis,
						'exams' 		=>  $val->exams,
						'studies' 		=>  $val->studies,
						'medications_supplements' 		=>  json_decode($val->medications_supplements),
						'status_exam' 		=>  $val->status_exam,
						'status_study' 		=> $val->status_study,
						'study' 		=> $val->get_study_medical,
						'exam' 		=> $val->get_exam_medical,
						'sintomas' 		=> $val->sintomas,
					],
				];
			}

			return $medical_record_user;
			//code...
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_medical_record_user()', $message);
		}
	}

	static function get_doctor_centers()
	{
		try {
			$doctor_centers = [];
			$dataCenters = DoctorCenter::where('user_id', Auth::user()->id)->get();
			foreach ($dataCenters as $key => $val) {
				$doctor_centers[$key] = [
					'id' =>  $val->id,
					'center' =>  $val->get_center->description,
					'address' =>  $val->address,
					'number_floor' =>  $val->number_floor,
					'phone_consulting_room' =>  $val->phone_consulting_room,
					"number_consulting_room" => $val->number_consulting_room,
					"status" => $val->status,
				];
			}
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

			$centers = Center::where('corporate', 'false')->get();
			return $centers;
			//code...
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_doctor_centers()', $message);
		}
	}

	static function get_centers_state($state)
	{
		try {

			$centers = Center::where('state', $state)->get();
			return $centers;
			//code...
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_doctor_centers()', $message);
		}
	}

	static function notification_register_mail($verification_code, $email, $name, $type)
	{

		try {

			$mailData = [
				'name' => $name,
			];
			if ($type == 'p') {
				$mailData = [
					'name' => $name,
				];
				$view = 'emails.register_patient';
				$cuerpo1 = 'prueba1';
				$cuerpo2 = 'prueba2';
				Mail::to($email)->send(new SendMail($mailData, $verification_code, $view, $cuerpo1, $cuerpo2));
			}
			if ($type == 'm') {
				$view = 'emails.demoMail';
				$cuerpo1 = 'prueba1';
				$cuerpo2 = 'prueba2';
				Mail::to($email)->send(new SendMail($mailData, $verification_code, $view, $cuerpo1, $cuerpo2));
			}
			if ($type == 'up') {
				$mailData = [
					'title' => 'Actualizacion de Correo Electronico',
					'name' => $name,
				];
				$view = 'emails.demoMail';
				$cuerpo1 = 'Usted a solicitado el cambio de su direccion de correo electronico.';
				$cuerpo2 = 'Por favor introdusca el siguiente codigo de validacion:';
				Mail::to($email)->send(new SendMail($mailData, $verification_code, $view, $cuerpo1, $cuerpo2));
			}
			if ($type == 'rp') {
				$mailData = [
					'title' => 'Recuperacion de contraseña',
					'name' => 'Correo electronico introducido: ' . $name,
				];
				$view = 'emails.demoMail';
				$cuerpo1 = 'Usted a solicitado el cambio de su contraseña por motivos de olvido o actualizacion de datos.';
				$cuerpo2 = 'Por favor introduzca el siguiente codigo de validacion:';
				Mail::to($email)->send(new SendMail($mailData, $verification_code, $view, $cuerpo1, $cuerpo2));
			}
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.send_mail()', $message);
		}
	}

	static function notification_mail($mailData, $type)
	{

		try {

			if ($type == 'register_patient') {
				$view = 'emails.register_patient';
				Mail::to($mailData['dr_email'])->send(new NotificationEmail($mailData, $view));
			}

			if ($type == 'patient_minor') {
				$view = 'emails.patient_minor';
				Mail::to($mailData['patient_email'])->send(new NotificationEmail($mailData, $view));
			}

			if ($type == 'patient') {
				$view = 'emails.patient';
				Mail::to($mailData['patient_email'])->send(new NotificationEmail($mailData, $view));
			}

			if ($type == 'center') {
				$view = 'emails.center';
				Mail::to($mailData['dr_email'])->send(new NotificationEmail($mailData, $view));
			}

			if ($type == 'appointment') {
				$view = 'emails.cita';
				Mail::to($mailData['patient_email'])->send(new NotificationEmail($mailData, $view));
			}

			if ($type == 'verify_email') {
				$view = 'emails.verify_email';
				Mail::to($mailData['dr_email'])->send(new NotificationEmail($mailData, $view));
			}

			if ($type == 'verify_email_laboratory') {
				$view = 'emails.verify_email_laboratory';
				Mail::to($mailData['laboratory_email'])->send(new NotificationEmail($mailData, $view));
			}

			if ($type == 'verify_email_corporate') {
				$view = 'emails.verify_email_corporate';
				Mail::to($mailData['laboratory_email'])->send(new NotificationEmail($mailData, $view));
			}

			if ($type == 'reference') {
				$view = 'emails.references';
				Mail::to($mailData['patient_email'])->send(new NotificationEmail($mailData, $view));
			}

			if ($type == 'reset_pass') {
				$view = 'emails.reset_pass';
				Mail::to($mailData['dr_email'])->send(new NotificationEmail($mailData, $view));
			}

			if ($type == 'update_email') {
				$view = 'emails.update_email';
				Mail::to($mailData['dr_email'])->send(new NotificationEmail($mailData, $view));
			}

			if ($type == 'enable_doc') {
				$view = 'emails.enable_email';
				Mail::to($mailData['dr_email'])->send(new NotificationEmail($mailData, $view));
			}

			if ($type == 'disable_doc') {
				$view = 'emails.disable_email';
				Mail::to($mailData['dr_email'])->send(new NotificationEmail($mailData, $view));
			}

			if ($type == 'verify_email_general_manager') {
				$view = 'emails.verify_email_general_manager';
				Mail::to($mailData['gm_email'])->send(new NotificationEmail($mailData, $view));
			}
			if ($type == 'recovery_pass_pat') {
				$view = 'emails.recovery_pass_pat';
				Mail::to($mailData['email'])->send(new NotificationEmail($mailData, $view));
			}
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.send_mail()', $message);
		}
	}

	static function verify_email($verification_code)
	{

		try {

			$date = date('Y-m-d H:m:ss');
			$verify = DB::table('users')
				->where('verification_code', $verification_code)
				->update(['email_verified_at' => $date]);

			$action = '19';

			ActivityLogController::store_log($action);

			return redirect('/')->with('success', 'Has confirmado correctamente tu correo!');
			//code...
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.verify_email()', $message);
		}
	}

	/**
	 * Funcion que para la verificacion del correo
	 *
	 * @param verification_code
	 */
	static function patient_verify_email($verification_code)
	{

		try {

			$date = date('Y-m-d H:m:ss');
			$verify = DB::table('patients')
				->where('verification_code', $verification_code)
				->update(['email_verified_at' => $date]);
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.patient_verify_email()', $message);
		}
	}

	/**
	 * Funcion que envia las notificaciones al paciente y al medico
	 * justo despues que la cita es creada a nivel de sistemas
	 *
	 * @param email 		-> direccion de correo del medico
	 * @param patient_email -> correo del paciente
	 */
	static function notification_dairy_email($email, $patient_email, $mailData)
	{
		try {

			Mail::to($email)->send(new NotificationDairy($mailData));
			Mail::to($patient_email)->send(new NotificationPatient($mailData));
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.notification_dairy_email()', $message);
		}
	}

	static function get_patient_history($id)
	{
		try {

			$patient_history = History::where('id', $id)->get();

			return $patient_history;
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_patient_history()', $message);
		}
	}

	static function get_history_vital_sing()
	{
		try {

			$VitalSign = VitalSign::all();

			return $VitalSign;
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_history_vital_sing()', $message);
		}
	}

	static function get_history_family_back()
	{
		try {

			$family_back = FamilyBackground::all();

			return $family_back;
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_history_family_back()', $message);
		}
	}

	static function get_history_pathology_back()
	{
		try {

			$pathology_back = PathologicalBackground::all();

			return $pathology_back;
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_history_pathology_back()', $message);
		}
	}

	static function get_history_non_pathology_back()
	{
		try {

			$non_pathology_back = NonPathologicalBackground::all();

			return $non_pathology_back;
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_history_non_pathology_back()', $message);
		}
	}

	static function get_condition()
	{
		try {

			$Condition = Condition::all();

			return $Condition;
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.Condition()', $message);
		}
	}

	static function get_image_patient($imgen)
	{

		try {
			$file = Storage::disk('app/img/')->get($imgen);
			return $file;
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_image_patient()', $message);
		}
	}

	static function get_patient_code($ci)
	{
		try {

			$patient_code = 'SQ-' . $ci . '-' . random_int(111, 999);

			return $patient_code;
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_image_patient()', $message);
		}
	}

	/*
	|--------------------------------------------------------------------------
	| Funciones para grafico estadistico general
	|--------------------------------------------------------------------------
	|
	| Se calculan los ninos y ninas, jovenes, adultos y adulto mayor
	| Todos los calculos viene discriminados por genero
	| Masculino y Femenino
	|
	*/

	/**
	 * Ninos y ninas
	 */
	static function get_patient_boy_girl()
	{
		try {
			$patient_genere_femenino =  Patient::where('genere', '=', 'femenino')
				->where('age', '<=', 11)
				->count();

			$patient_genere_masculino  =  Patient::where('genere', '=', 'masculino')
				->where('age', '<=', 11)
				->count();

			return ["femenino" => $patient_genere_femenino, 'masculino' => $patient_genere_masculino];
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_patient_boy_girl()', $message);
		}
	}

	/**
	 * Jovenes
	 */
	static function get_patient_teen()
	{
		try {
			$patient_genere_femenino = Patient::where('genere', '=', 'femenino')
				->WhereBetween('age', [12, 18])
				->count();

			$patient_genere_masculino = Patient::where('genere', '=', 'masculino')
				->WhereBetween('age', [12, 18])
				->count();

			return ["femenino" => $patient_genere_femenino, 'masculino' => $patient_genere_masculino];
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_patient_teen()', $message);
		}
	}

	/**
	 * Adultos
	 */
	static function get_patient_adult()
	{
		try {
			$patient_genere_femenino =  Patient::where('genere', '=', 'femenino')
				->WhereBetween('age', [19, 40])
				->count();
			$patient_genere_masculino =  Patient::where('genere', '=', 'masculino')
				->WhereBetween('age', [19, 40])
				->count();

			return ["femenino" => $patient_genere_femenino, 'masculino' => $patient_genere_masculino];
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_patient_adult()', $message);
		}
	}

	/**
	 * Adulto mayor
	 */
	static function get_patient_elderly()
	{
		try {
			$patient_genere_femenino =  Patient::where('genere', '=', 'femenino')
				->where('age', '>', 41)
				->count();

			$patient_genere_masculino =  Patient::where('genere', '=', 'masculino')
				->where('age', '>', 41)
				->count();

			return ["femenino" => $patient_genere_femenino, 'masculino' => $patient_genere_masculino];
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_patient_elderly()', $message);
		}
	}

	/**
	 * Confirmacion de cita por parte del paciente
	 * @param code de la cita
	 */
	static function confirmation_dairy($code)
	{
		try {

			$update = DB::table('appointments')
				->where('code', $code)
				->update([
					'status' => 2,
				]);

			return true;
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.confirmation_dairy()', $message);
		}
	}

	/**
	 * Funcion que envia las notificaciones al paciente y al medico
	 * justo despues que la cita es creada a nivel de sistemas
	 *
	 * @param email 		-> direccion de correo del medico
	 * @param patient_email -> correo del paciente
	 */
	static function notification_ref_email($patient_email, $mailData)
	{
		try {

			Mail::to($patient_email)->send(new NotificationReferences($mailData));
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.notification_ref_email()', $message);
		}
	}

	static function get_image_lab($lab_email)
	{
		try {

			$lab_img = Laboratory::where('email', $lab_email)->first();
			$img = $lab_img->lab_img;
			return $img;
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_image_lab()', $message);
		}
	}

	static function exit_image_lab($lab_email)
	{
		try {

			$lab_img = Laboratory::where('email', $lab_email)->first();
			if ($lab_img != null) {
				$img = $lab_img->lab_img;
				return $img;
			} else {

				return null;
			}
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_image_lab()', $message);
		}
	}

	static function get_ref()
	{
		try {

			$reference = Reference::all();
			return $reference;
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_image_lab()', $message);
		}
	}

	static function get_all_ref()
	{
		try {
			$references = [];
			$reference = Reference::all();
			foreach ($reference as $key => $val) {
				$references[$key] = [
					'id' 			=>  $val->id,
					'date' 			=> $val->date,
					'cod_ref' 	=>  $val->cod_ref,
					'cod_medical_record' 	=>  $val->cod_medical_record,
					'name' 		=>  $val->get_patient->name . ' ' . $val->get_patient->last_name,
					'ci' 		=>  $val->get_patient->ci,
					'genere' 		=>  $val->get_patient->ci,
					'phone' 		=>  $val->get_patient->ci,
					'get_exam' => $val->get_exam,
					'get_studie' => $val->get_studie,
				];
			}

			// dd($references);

			return $references;
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_image_lab()', $message);
		}
	}
	static function upload_result_exam(Request $request)
	{
		try {

			$data = json_decode($request->data);
			$user_id = Auth::user();
			$laboratory = $user_id->get_laboratorio;

			$nameFile = null;

			$file =  $data->img;
			if ($file != null) {
				$png 	= strstr($file, 'data:image/png;base64');
				$jpg 	= strstr($file, 'data:image/jpg;base64');
				$jpeg 	= strstr($file, 'data:image/jpeg;base64');
				$pdf 	= strstr($file, 'data:application/pdf;base64');
				if ($png != null) {
					$file = str_replace("data:image/png;base64,", "", $file);
					$file = base64_decode($file);
					$extension = ".png";
				} elseif ($jpeg != null) {
					$file = str_replace("data:image/jpeg;base64,", "", $file);
					$file = base64_decode($file);
					$extension = ".jpeg";
				} elseif ($jpg != null) {
					$file = str_replace("data:image/jpg;base64,", "", $file);
					$file = base64_decode($file);
					$extension = ".jpg";
				} elseif ($pdf != null) {
					$file = str_replace("data:application/pdf;base64,", "", $file);
					$file = base64_decode($file);
					$extension = ".pdf";
				}
				$nameFile = uniqid() . $extension;

				file_put_contents(public_path('imgs/') . $nameFile, $file);
			}

			$data_exams = json_decode($data->exams_array);

			for ($i = 0; $i < count($data_exams); $i++) {
				if (isset($data->doctor_id)) {
					$update = DB::table('exam_patients')
						->where('cod_ref', $data->code_ref)
						->where('cod_exam', $data_exams[$i]->cod_exam)
						->update([
							'upload_user_id' => $data->doctor_id,
							'file' => $nameFile,
							'status' => 2,
							'date_result' => date('d-m-Y'),
						]);
				} else {

					$update = DB::table('exam_patients')
						->where('cod_ref', $data->code_ref)
						->where('cod_exam', $data_exams[$i]->cod_exam)
						->update([
							'laboratory_id' => $laboratory->id,
							'cod_lab' => $laboratory->code_lab,
							'file' => $nameFile,
							'status' => 2,
							'date_result' => date('d-m-Y'),
						]);
				}
			}

			$medical_record_code = Reference::where('cod_ref', $data->code_ref)->first()->cod_medical_record;
			$update = DB::table('medical_records')
				->where('record_code', $medical_record_code)
				->update([
					'status_exam' => true,
				]);


			return true;
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.upload_result_exam()', $message);
		}
	}

	static function upload_result_study(Request $request)
	{
		try {

			$data = json_decode($request->data);

			$user_id = Auth::user();
			$laboratory = $user_id->get_laboratorio;

			$nameFile = null;

			$file =  $data->img;
			if ($file != null) {
				$png 	= strstr($file, 'data:image/png;base64');
				$jpg 	= strstr($file, 'data:image/jpg;base64');
				$jpeg 	= strstr($file, 'data:image/jpeg;base64');
				$pdf 	= strstr($file, 'data:application/pdf;base64');
				if ($png != null) {
					$file = str_replace("data:image/png;base64,", "", $file);
					$file = base64_decode($file);
					$extension = ".png";
				} elseif ($jpeg != null) {
					$file = str_replace("data:image/jpeg;base64,", "", $file);
					$file = base64_decode($file);
					$extension = ".jpeg";
				} elseif ($jpg != null) {
					$file = str_replace("data:image/jpg;base64,", "", $file);
					$file = base64_decode($file);
					$extension = ".jpg";
				} elseif ($pdf != null) {
					$file = str_replace("data:application/pdf;base64,", "", $file);
					$file = base64_decode($file);
					$extension = ".pdf";
				}
				$nameFile = uniqid() . $extension;

				file_put_contents(public_path('imgs/') . $nameFile, $file);
			}

			$data_studies = json_decode($data->studies_array);

			for ($i = 0; $i < count($data_studies); $i++) {
				if (isset($data->doctor_id)) {
					$update = DB::table('study_patients')
						->where('cod_ref', $data->code_ref)
						->where('cod_study', $data_studies[$i]->cod_study)
						->update([
							'upload_user_id' => $data->doctor_id,
							'file' => $nameFile,
							'status' => 2,
							'date_result' => date('d-m-Y'),
						]);
				} else {

					$update = DB::table('study_patients')
						->where('cod_ref', $data->code_ref)
						->where('cod_study', $data_studies[$i]->cod_study)
						->update([
							'laboratory_id' => $laboratory->id,
							'cod_lab' => $laboratory->code_lab,
							'file' => $nameFile,
							'status' => 2,
							'date_result' => date('d-m-Y'),
						]);
				}
			}

			$medical_record_code = Reference::where('cod_ref', $data->code_ref)->first()->cod_medical_record;
			$update = DB::table('medical_records')
				->where('record_code', $medical_record_code)
				->update([
					'status_study' => true,
				]);

			return true;
			//code...
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.upload_result_study()', $message);
		}
	}


	static function get_description_exam($code)
	{
		try {
			$description = Exam::where('cod_exam', $code)->first();
			return $description->description;
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_description_exam()', $message);
		}
	}

	static function get_description_study($code)
	{
		try {
			$description = Study::where('cod_study', $code)->first();
			return $description->description;
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_description_study()', $message);
		}
	}

	static function update_patient_counter($user_id)
	{
		try {
			$value = User::where('id', $user_id)->first();
			if ($value->type_plane != '7') {
				$counter = DB::table('users')
					->where('id', $user_id)
					->update([
						'patient_counter' => $value->patient_counter + 1,
					]);
			}
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.update_patient_counter()', $message);
		}
	}

	static function update_mr_counter($user_id)
	{
		try {
			$value = User::where('id', $user_id)->first();
			if ($value->type_plane != '7') {
				$counter = DB::table('users')
					->where('id', $user_id)
					->update([
						'medical_record_counter' => $value->medical_record_counter + 1,
					]);
			}
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.update_mr_counter()', $message);
		}
	}

	static function update_ref_counter($user_id)
	{
		try {
			$value = User::where('id', $user_id)->first();
			if ($value->type_plane != '7') {
				$counter = DB::table('users')
					->where('id', $user_id)
					->update([
						'ref_counter' => $value->ref_counter + 1,
					]);
			}
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.update_ref_exam_counter()', $message);
		}
	}

	static function get_table_medical_record($id)
	{
		try {

			$user = Auth::user();
			// MedicalRecord::where('user_id', $user->id)->get()->unique('patient_id');

			$medical_record = Patient::where('user_id', $id)
				->with('get_patient_medical_record')->get();
			return $medical_record;
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_table_medical_record()', $message);
		}
	}

	static function search_person($value, $row)
	{

		$data = [];

		if ($row != 'cod_ref') {

			$pat = Patient::where("ci", $value)
				->orwhereHas('get_reprensetative', function ($q) use ($value) {
					$q->where('re_ci', $value);
				})->get();

			$tablePat =  ExamPatient::where('status', 2)
				->whereHas('get_patients', function ($q) use ($value) {
					$q->where('ci', $value);
				});

			$tableRep =  ExamPatient::where('status', 2)
				->whereHas('get_patients', function ($q) use ($value) {
					$q->whereHas('get_reprensetative', function ($q) use ($value) {
						$q->where('re_ci', $value);
					});
				});

			$data = $tablePat->union($tableRep)
				->with(['get_laboratory', 'get_patients', 'get_reprensetative'])
				->skip(0)     // punto de partida
				->take(10)   // limite de resgistro
				->get();

			$count =  $tablePat->union($tableRep)->get();

			$data = [
				"data" => $data,
				"count" => count($count),
				"skip" => 0,
				"limit" => 10,
			];

			///buscar las referencias sin resultados cargados

			$Reference_pat =  Reference::whereHas('get_patient', function ($q) use ($value) {
				$q->where('ci', $value);
			});

			$Reference_reo =  Reference::whereHas('get_patient', function ($q) use ($value) {
				$q->whereHas('get_reprensetative', function ($q) use ($value) {
					$q->where('re_ci', $value);
				});
			});



			$reference = $Reference_pat->union($Reference_reo)
				->with(['get_patient', 'get_examne_stutus_uno', 'get_reprensetative'])
				->skip(0)     // punto de partida
				->take(10)   // limite de resgistro
				->get();

			$countDos = $Reference_pat->union($Reference_reo)->get();

			$reference = [
				"data" => $reference,
				"count" => count($countDos),
				"skip" => 0,
				"limit" => 10,
			];

			return ["data" => $data, "reference" => $reference, "pat" => $pat];
		} else {

			$tablePat =  Reference::whereHas('get_patient', function ($q) use ($value) {
				$q->where('ci', $value);
			});

			$tableRep =  Reference::whereHas('get_patient', function ($q) use ($value) {
				$q->whereHas('get_reprensetative', function ($q) use ($value) {
					$q->where('re_ci', $value);
				});
			});

			$reference = $tablePat->union($tableRep)->get();

			foreach ($reference as $key => $val) {
				$data[$key] = [
					'id' => $val->id,
					'cod_ref' => $val->cod_ref,
					'date' => $val->date,
					'cod_medical_record' => $val->cod_medical_record,
					'get_exam' => $val->get_exam,
					'get_studie' => $val->get_studie,
					'get_patient' => $val->get_patient,
				];
			}

			return $data;
		}
	}

	static function search_studio($value, $row)
	{

		$data = [];
		if ($row != 'cod_ref') {


			$pat = Patient::where("ci", $value)
				->orwhereHas('get_reprensetative', function ($q) use ($value) {
					$q->where('re_ci', $value);
				})->get();

			$tablePat =  StudyPatient::where('status', 2)
				->whereHas('get_patient', function ($q) use ($value) {
					$q->where('ci', $value);
				});

			$tableRep =  StudyPatient::where('status', 2)
				->whereHas('get_patient', function ($q) use ($value) {
					$q->whereHas('get_reprensetative', function ($q) use ($value) {
						$q->where('re_ci', $value);
					});
				});

			$data = $tablePat->union($tableRep)
				->with(['get_laboratory', 'get_patient', 'get_reprensetative'])
				->skip(0)     // punto de partida
				->take(10)   // limite de resgistro
				->get();

			$count = $data = $tablePat->union($tableRep)->get();

			$data = [
				"data" => $data,
				"count" => count($count),
				"skip" => 0,
				"limit" => 10,
			];

			//buscar las referencias sin resultados cargados

			$Reference_pat =  Reference::whereHas('get_patient', function ($q) use ($value) {
				$q->where('ci', $value);
			});

			$Reference_reo =  Reference::whereHas('get_patient', function ($q) use ($value) {
				$q->whereHas('get_reprensetative', function ($q) use ($value) {
					$q->where('re_ci', $value);
				});
			});

			$reference = $Reference_pat->union($Reference_reo)
				->with(['get_patient', 'get_estudio_stutus_uno', 'get_reprensetative'])
				->skip(0)     // punto de partida
				->take(10)   // limite de resgistro
				->get();

			$countDos = $Reference_pat->union($Reference_reo)->get();

			$reference = [
				"data" => $reference,
				"count" => count($countDos),
				"skip" => 0,
				"limit" => 10,
			];

			return ["data" => $data, "reference" => $reference, "pat" => $pat];
		}
	}

	static function responce_references()
	{

		$data_exam_res = ComponentsLaboratory::res_exams();

		$data_study_res = ComponentsLaboratory::res_studies();

		return ["data_exam_res" => $data_exam_res, "data_study_res" => $data_study_res];
	}

	static function update_status_dairy($id)
	{
		try {
			$user_id = Auth::user()->id;
			$appointments = Appointment::where('user_id', $user_id)->where('id', $id)
				->update([
					'status' 		=> 3,
				]);
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.update_status_dairy()', $message);
		}
	}

	/*
	|--------------------------------------------------------------------------
	| Funciones para grafico estadistico general del laboratorio
	|--------------------------------------------------------------------------
	|
	| Se calculan el total de examenes atendidos por el laboratio
	| asi como los el total de examenes y studios diferentes
	| que son atendidios
	|
	*/

	/**
	 * Gráfico 1
	 * Total de examenes atendidos
	 */
	static function total_exams()
	{
		try {
			$total_exams = [];
			if (Auth::user()->get_laboratorio != null) {
				$user_id = Auth::user()->get_laboratorio->id;
				$total_exams =  ExamPatient::where('laboratory_id', $user_id)->count();
			}
			return $total_exams;
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.total_exams()', $message);
		}
	}

	/**
	 * Gráfico 2
	 * Total de studios atendidos
	 */
	static function total_studies($id)
	{
		try {
			$total_studies = [];
			if (Auth::user()->get_laboratorio != null) {
				$user_id = Auth::user()->get_laboratorio->id;
				$total_studies =  StudyPatient::where('laboratory_id', $id)->count();
			}
			return $total_studies;
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.total_studies()', $message);
		}
	}

	static function get_counter()
	{
		try {

			$user_patient_counter = Auth::user()->patient_counter;
			return $user_patient_counter;
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.total_studies()', $message);
		}
	}

	/**
	 * Metodos para listar informacion
	 * del plan corporativo.
	 *
	 * Esta informacion sera colocada en tablas
	 * para ser vista en el dashboard del medico administrador
	 */

	static function get_patient_corporate()
	{
		try {

			$user = Auth::user();
			$lista_patient = Patient::where('center_id', $user->center_id)->get();
			return $lista_patient;
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_patient_corporate()', $message);
		}
	}

	static function get_medical_record_corporate()
	{
		try {

			$user = Auth::user();
			$lista_medical_record = MedicalRecord::where('center_id', $user->center_id)->get();
			return $lista_medical_record;
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_medical_record_corporate()', $message);
		}
	}

	static function get_doctor_corporate()
	{
		try {

			$user = Auth::user();
			$lista_doctor = User::where('center_id', $user->center_id)->where('role', 'medico')->get();
			return $lista_doctor;
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_doctor_corporate()', $message);
		}
	}

	static function get_list_exam()
	{
		try {

			$list_exam = Exam::all();
			return $list_exam;
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_list_exam()', $message);
		}
	}

	static function get_list_study()
	{
		try {

			$list_study = Study::all();
			return $list_study;
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_list_study()', $message);
		}
	}

	static function habilitar_doctor_corporate($id)
	{
		try {

			$doctor = User::where('id', $id)
				->where('type_plane', '7')
				->update([
					'tipo_status' => '1'
				]);

			$doctor_update = UtilsController::get_doctor_corporate();

			$info_doctor = User::where('id', $id)->where('type_plane', '7')->first();
			$type = 'enable_doc';
			$mailData = [
				'dr_name' => $info_doctor->name . ' ' . $info_doctor->last_name,
				'dr_email' => $info_doctor->email,
				'center' => Center::where('id', $info_doctor->center_id)->first()->description
			];

			UtilsController::notification_mail($mailData, $type);

			return $doctor_update;
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.update_status_doctor_corporate()', $message);
		}
	}

	static function deshabilitar_doctor_corporate($id)
	{
		try {

			$doctor = User::where('id', $id)
				->where('type_plane', '7')
				->update([
					'tipo_status' => '2'
				]);

			$doctor_update = UtilsController::get_doctor_corporate();
			$info_doctor = User::where('id', $id)->where('type_plane', '7')->first();
			$type = 'disable_doc';
			$mailData = [
				'dr_name' => $info_doctor->name . ' ' . $info_doctor->last_name,
				'dr_email' => $info_doctor->email,
				'center' => Center::where('id', $info_doctor->center_id)->first()->description
			];

			UtilsController::notification_mail($mailData, $type);

			return $doctor_update;
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.update_status_doctor_corporate()', $message);
		}
	}

	static function sqlapio_ia(Request $request)
	{
		try {

			$token = DB::table('tokens')->select('token')->get();
			$array_res = $token->toArray();
			$list_token = Arr::pluck($array_res, 'token');

			/** Selecion aleatoria */
			$n = count($list_token);
			$rand = mt_rand(0, $n - 1);
			$secret_key = 'Bearer ' . $list_token[$rand];

			$data = Http::withHeaders([
				'Content-Type' => 'application/json',
				'Accept' => 'application/json',
				'Authorization' => $secret_key,
			])
				->post("https://api.openai.com/v1/chat/completions", [
					"model" => "gpt-3.5-turbo",
					'messages' => [
						[
							"role" => "user",
							"content" => "Actua como medico y realiza un diagnostico para un paciente " . $request->genere . " de " . $request->age . " años con los siguientes sintomas: " . $request->symtoms . ". Agrega 3 recomendaciones generales y recomienda 3 examenes medicos."
						]
					],
					'temperature' => 1,
					"max_tokens" => 1024,
					"n" => 1,
					"stream" => false,
					"top_p" => 1,
					"frequency_penalty" => 0,
					"presence_penalty" => 0,
				]);

			$res = $data->json()['choices'][0]['message']['content'];

			return response()->json([
				'success' => 'true',
				'data'  =>  $res
			], 200);
		} catch (\Throwable $th) {

			$message = $th->getMessage();
			dd('Error UtilsController.sqlapio_ia()', $message);
		}
	}
	static function get_medical_report($id)
	{
		try {
			$medical_report = MedicalReport::where('patient_id', $id)->with('get_doctor')->get();
			return $medical_report;
			//code...
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_medical_record_user()', $message);
		}
	}

	static function color_dairy()
	{
		try {

			$colors = [
				'rgb(128,0,0)',
				'rgb(0,139,139)',
				'rgb(70,130,180)',
				'rgb(112,128,144)',
				'rgb(250,128,114)'
			];

			/** Selecion aleatoria */
			$n = count($colors);
			$rand = mt_rand(0, $n - 1);
			$color_appointments = $colors[$rand];

			return $color_appointments;
		} catch (\Throwable $th) {

			return response()->json([
				'success' => 'true',
				'data'  =>  $th->getMessage()
			], 400);
		}
	}

	// static function reloadCapchat()
	// {
	// 	return Captcha::img('flat');
	// }

	// static function validateCapchat(Request $request)
	// {
	// 	$rules = ['captcha' => 'required|captcha:' . request('key') . ',math'];

	// 	$msj = [
	// 		'captcha.required' => 'campo requerido',
	// 		'captcha.captcha' => 'codigo invalida',

	// 	];

	// 	$validator = Validator::make($request->all(), $rules, $msj);

	// 	if ($validator->fails()) {

	// 		return false;

	// 	} else {

	// 		return true;
	// 	}
	// }

	static function generete_pass($ci)
	{
		try {
			$pass = substr(md5(mt_rand()), 0, 7) . "/" . substr($ci, 0, 3);
			return $pass;
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_image_patient()', $message);
		}
	}

	static function get_queries_month($month = null,$id)
	{
		try {

			if ($month) {
				$January = MedicalRecord::where("user_id", $id)
					->whereMonth("created_at", ($month == "01") ? $month : null)->count();

				$February = MedicalRecord::where("user_id", $id)
					->whereMonth("created_at", ($month == "02") ? $month : null)->count();

				$March = MedicalRecord::where("user_id", $id)
					->whereMonth("created_at", ($month == "03") ? $month : null)->count();

				$April = MedicalRecord::where("user_id", $id)
					->whereMonth("created_at", ($month == "04") ? $month : null)->count();

				$May = MedicalRecord::where("user_id", $id)
					->whereMonth("created_at", ($month == "05") ? $month : null)->count();

				$June = MedicalRecord::where("user_id", $id)
					->whereMonth("created_at", ($month == "06") ? $month : null)->count();

				$julio  = MedicalRecord::where("user_id", $id)
					->whereMonth("created_at", ($month == "07") ? $month : null)->count();

				$agosto = MedicalRecord::where("user_id", $id)
					->whereMonth("created_at", ($month == "08") ? $month : null)->count();

				$septiembre = MedicalRecord::where("user_id", $id)
					->whereMonth("created_at", ($month == "09") ? $month : null)->count();

				$October = MedicalRecord::where("user_id", $id)
					->whereMonth("created_at", ($month == "10") ? $month : null)->count();

				$November = MedicalRecord::where("user_id", $id)
					->whereMonth("created_at", ($month == "11") ? $month : null)->count();

				$December = MedicalRecord::where("user_id", $id)
					->whereMonth("created_at", ($month == "12") ? $month : null)->count();

				return [
					$January, $February,
					$March, $April, $May,
					$June, $julio, $agosto,
					$septiembre, $October,
					$November, $December
				];
			} else {

				$January = MedicalRecord::where("user_id", $id)
					->whereMonth("created_at", "01")->count();

				$February = MedicalRecord::where("user_id", $id)
					->whereMonth("created_at", "02")->count();

				$March = MedicalRecord::where("user_id", $id)
					->whereMonth("created_at", "03")->count();

				$April = MedicalRecord::where("user_id", $id)
					->whereMonth("created_at", "04")->count();

				$May = MedicalRecord::where("user_id", $id)
					->whereMonth("created_at", "05")->count();

				$June = MedicalRecord::where("user_id", $id)
					->whereMonth("created_at", "06")->count();

				$julio  = MedicalRecord::where("user_id", $id)
					->whereMonth("created_at", "07")->count();

				$agosto = MedicalRecord::where("user_id", $id)
					->whereMonth("created_at", "08")->count();

				$septiembre = MedicalRecord::where("user_id", $id)
					->whereMonth("created_at", "09")->count();

				$October = MedicalRecord::where("user_id", $id)
					->whereMonth("created_at", "10")->count();

				$November = MedicalRecord::where("user_id", $id)
					->whereMonth("created_at", "11")->count();

				$December = MedicalRecord::where("user_id", $id)
					->whereMonth("created_at", "12")->count();

				return [
					$January, $February,
					$March, $April, $May,
					$June, $julio, $agosto,
					$septiembre, $October,
					$November, $December
				];
			}
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_image_patient()', $message);
		}
	}

	static function get_appointments_attended($month = null,$id)
	{
		try {

			if ($month) {
				$January = Appointment::where("user_id", auth()->user()->id)
					->whereMonth("created_at", ($month == "01") ? $month : null)->where("status", "3")->count();

				$February = Appointment::where("user_id", auth()->user()->id)
					->whereMonth("created_at", ($month == "02") ? $month : null)->where("status", "3")->count();

				$March = Appointment::where("user_id", auth()->user()->id)
					->whereMonth("created_at", ($month == "03") ? $month : null)->where("status", "3")->count();

				$April = Appointment::where("user_id", auth()->user()->id)
					->whereMonth("created_at", ($month == "04") ? $month : null)->where("status", "3")->count();

				$May = Appointment::where("user_id", auth()->user()->id)
					->whereMonth("created_at", ($month == "05") ? $month : null)->where("status", "3")->count();

				$June = Appointment::where("user_id", auth()->user()->id)
					->whereMonth("created_at", ($month == "06") ? $month : null)->where("status", "3")->count();

				$julio  = Appointment::where("user_id", auth()->user()->id)
					->whereMonth("created_at", ($month == "07") ? $month : null)->where("status", "3")->count();

				$agosto = Appointment::where("user_id", auth()->user()->id)
					->whereMonth("created_at", ($month == "08") ? $month : null)->where("status", "3")->count();

				$septiembre = Appointment::where("user_id", auth()->user()->id)
					->whereMonth("created_at", ($month == "09") ? $month : null)->where("status", "3")->count();

				$October = Appointment::where("user_id", auth()->user()->id)
					->whereMonth("created_at", ($month == "10") ? $month : null)->where("status", "3")->count();

				$November = Appointment::where("user_id", auth()->user()->id)
					->whereMonth("created_at", ($month == "11") ? $month : null)->where("status", "3")->count();

				$December = Appointment::where("user_id", auth()->user()->id)
					->whereMonth("created_at", ($month == "12") ? $month : null)->where("status", "3")->count();

				return [
					$January, $February,
					$March, $April, $May,
					$June, $julio, $agosto,
					$septiembre, $October,
					$November, $December
				];
			} else {
				$January = Appointment::where("user_id", auth()->user()->id)
					->whereMonth("created_at", "01")->where("status", "3")->count();

				$February = Appointment::where("user_id", auth()->user()->id)
					->whereMonth("created_at", "02")->where("status", "3")->count();

				$March = Appointment::where("user_id", auth()->user()->id)
					->whereMonth("created_at", "03")->where("status", "3")->count();

				$April = Appointment::where("user_id", auth()->user()->id)
					->whereMonth("created_at", "04")->where("status", "3")->count();

				$May = Appointment::where("user_id", auth()->user()->id)
					->whereMonth("created_at", "05")->where("status", "3")->count();

				$June = Appointment::where("user_id", auth()->user()->id)
					->whereMonth("created_at", "06")->where("status", "3")->count();

				$julio  = Appointment::where("user_id", auth()->user()->id)
					->whereMonth("created_at", "07")->where("status", "3")->count();

				$agosto = Appointment::where("user_id", auth()->user()->id)
					->whereMonth("created_at", "08")->where("status", "3")->count();

				$septiembre = Appointment::where("user_id", auth()->user()->id)
					->whereMonth("created_at", "09")->where("status", "3")->count();

				$October = Appointment::where("user_id", auth()->user()->id)
					->whereMonth("created_at", "10")->where("status", "3")->count();

				$November = Appointment::where("user_id", auth()->user()->id)
					->whereMonth("created_at", "11")->where("status", "3")->count();

				$December = Appointment::where("user_id", auth()->user()->id)
					->whereMonth("created_at", "12")->where("status", "3")->count();

				return [
					$January, $February,
					$March, $April, $May,
					$June, $julio, $agosto,
					$septiembre, $October,
					$November, $December
				];
			}
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_image_patient()', $message);
		}
	}
	static function get_appointments_canceled($month = null,$id)
	{
		try {

			if ($month) {

				$January = Appointment::where("user_id", $id)
					->whereMonth("created_at", ($month == "01") ? $month : null)->where("status", "4")->count();

				$February = Appointment::where("user_id", $id)
					->whereMonth("created_at", ($month == "02") ? $month : null)->where("status", "4")->count();

				$March = Appointment::where("user_id", $id)
					->whereMonth("created_at", ($month == "03") ? $month : null)->where("status", "4")->count();

				$April = Appointment::where("user_id", $id)
					->whereMonth("created_at", ($month == "04") ? $month : null)->where("status", "4")->count();

				$May = Appointment::where("user_id", $id)
					->whereMonth("created_at", ($month == "05") ? $month : null)->where("status", "4")->count();

				$June = Appointment::where("user_id", $id)
					->whereMonth("created_at", ($month == "06") ? $month : null)->where("status", "4")->count();

				$julio  = Appointment::where("user_id", $id)
					->whereMonth("created_at", ($month == "07") ? $month : null)->where("status", "4")->count();

				$agosto = Appointment::where("user_id", $id)
					->whereMonth("created_at", ($month == "08") ? $month : null)->where("status", "4")->count();

				$septiembre = Appointment::where("user_id", $id)
					->whereMonth("created_at", ($month == "09") ? $month : null)->where("status", "4")->count();

				$October = Appointment::where("user_id", $id)
					->whereMonth("created_at", ($month == "10") ? $month : null)->where("status", "4")->count();

				$November = Appointment::where("user_id", $id)
					->whereMonth("created_at", ($month == "11") ? $month : null)->where("status", "4")->count();

				$December = Appointment::where("user_id", $id)
					->whereMonth("created_at", ($month == "12") ? $month : null)->where("status", "4")->count();

				return [
					$January, $February,
					$March, $April, $May,
					$June, $julio, $agosto,
					$septiembre, $October,
					$November, $December
				];
			} else {
				$January = Appointment::where("user_id", $id)
					->whereMonth("created_at", "01")->where("status", "4")->count();

				$February = Appointment::where("user_id", $id)
					->whereMonth("created_at", "02")->where("status", "4")->count();

				$March = Appointment::where("user_id", $id)
					->whereMonth("created_at", "03")->where("status", "4")->count();

				$April = Appointment::where("user_id", $id)
					->whereMonth("created_at", "04")->where("status", "4")->count();

				$May = Appointment::where("user_id", $id)
					->whereMonth("created_at", "05")->where("status", "4")->count();

				$June = Appointment::where("user_id", $id)
					->whereMonth("created_at", "06")->where("status", "4")->count();

				$julio  = Appointment::where("user_id", $id)
					->whereMonth("created_at", "07")->where("status", "4")->count();

				$agosto = Appointment::where("user_id", $id)
					->whereMonth("created_at", "08")->where("status", "4")->count();

				$septiembre = Appointment::where("user_id", $id)
					->whereMonth("created_at", "09")->where("status", "4")->count();

				$October = Appointment::where("user_id", $id)
					->whereMonth("created_at", "10")->where("status", "4")->count();

				$November = Appointment::where("user_id", $id)
					->whereMonth("created_at", "11")->where("status", "4")->count();

				$December = Appointment::where("user_id", $id)
					->whereMonth("created_at", "12")->where("status", "4")->count();

				return [
					$January, $February,
					$March, $April, $May,
					$June, $julio, $agosto,
					$septiembre, $October,
					$November, $December
				];
			}
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_image_patient()', $message);
		}
	}

	static function get_appointments_confirmed($month = null,$id)
	{
		try {

			if ($month) {

				$January = Appointment::where("user_id", $id)
					->whereMonth("created_at", ($month == "01") ? $month : null)->where("status", "2")->count();

				$February = Appointment::where("user_id", $id)
					->whereMonth("created_at", ($month == "02") ? $month : null)->where("status", "2")->count();

				$March = Appointment::where("user_id", $id)
					->whereMonth("created_at", ($month == "03") ? $month : null)->where("status", "2")->count();

				$April = Appointment::where("user_id", $id)
					->whereMonth("created_at", ($month == "04") ? $month : null)->where("status", "2")->count();

				$May = Appointment::where("user_id", $id)
					->whereMonth("created_at", ($month == "05") ? $month : null)->where("status", "2")->count();

				$June = Appointment::where("user_id", $id)
					->whereMonth("created_at", ($month == "06") ? $month : null)->where("status", "2")->count();

				$julio  = Appointment::where("user_id", $id)
					->whereMonth("created_at", ($month == "07") ? $month : null)->where("status", "2")->count();

				$agosto = Appointment::where("user_id", $id)
					->whereMonth("created_at", ($month == "08") ? $month : null)->where("status", "2")->count();

				$septiembre = Appointment::where("user_id", $id)
					->whereMonth("created_at", ($month == "09") ? $month : null)->where("status", "2")->count();

				$October = Appointment::where("user_id", $id)
					->whereMonth("created_at", ($month == "10") ? $month : null)->where("status", "2")->count();

				$November = Appointment::where("user_id", $id)
					->whereMonth("created_at", ($month == "11") ? $month : null)->where("status", "2")->count();

				$December = Appointment::where("user_id", $id)
					->whereMonth("created_at", ($month == "12") ? $month : null)->where("status", "2")->count();

				return [
					$January, $February,
					$March, $April, $May,
					$June, $julio, $agosto,
					$septiembre, $October,
					$November, $December
				];
			} else {

				$January = Appointment::where("user_id", $id)
					->whereMonth("created_at", "01")->where("status", "2")->count();

				$February = Appointment::where("user_id", $id)
					->whereMonth("created_at", "02")->where("status", "2")->count();

				$March = Appointment::where("user_id", $id)
					->whereMonth("created_at", "03")->where("status", "2")->count();

				$April = Appointment::where("user_id", $id)
					->whereMonth("created_at", "04")->where("status", "2")->count();

				$May = Appointment::where("user_id", $id)
					->whereMonth("created_at", "05")->where("status", "2")->count();

				$June = Appointment::where("user_id", $id)
					->whereMonth("created_at", "06")->where("status", "2")->count();

				$julio  = Appointment::where("user_id", $id)
					->whereMonth("created_at", "07")->where("status", "2")->count();

				$agosto = Appointment::where("user_id", $id)
					->whereMonth("created_at", "08")->where("status", "2")->count();

				$septiembre = Appointment::where("user_id", $id)
					->whereMonth("created_at", "09")->where("status", "2")->count();

				$October = Appointment::where("user_id", $id)
					->whereMonth("created_at", "10")->where("status", "2")->count();

				$November = Appointment::where("user_id", $id)
					->whereMonth("created_at", "11")->where("status", "2")->count();

				$December = Appointment::where("user_id", $id)
					->whereMonth("created_at", "12")->where("status", "2")->count();

				return [
					$January, $February,
					$March, $April, $May,
					$June, $julio, $agosto,
					$septiembre, $October,
					$November, $December
				];
			}
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_image_patient()', $message);
		}
	}

	static function get_appointments_count_all($id)
	{
		try {

			$attended = Appointment::where("user_id", $id)
				->where("status", "3")->count();

			$canceled = Appointment::where("user_id", $id)
				->where("status", "4")->count();

			$confirmed = Appointment::where("user_id", $id)
				->where("status", "2")->count();

			return [$canceled, $attended, $confirmed];
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_image_patient()', $message);
		}
	}

	static function filter_month_dashboard($month)
	{
		try {

			$id= (Auth::user()->role=="secretary")?Auth::user()->master_corporate_id :Auth::user()->id;

			$get_queries_month = UtilsController::get_queries_month($month,$id);
			$get_appointments_attended = UtilsController::get_queries_month($month,$id);
			$get_appointments_canceled = UtilsController::get_appointments_canceled($month,$id);
			$get_appointments_confirmed = UtilsController::get_appointments_confirmed($month,$id);

			return [
				'get_queries_month' => $get_queries_month,
				'get_appointments_attended' => $get_appointments_attended,
				'get_appointments_canceled' => $get_appointments_canceled,
				'get_appointments_confirmed' => $get_appointments_confirmed,
			];
		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error UtilsController.get_image_patient()', $message);
		}
	}
}
