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
use App\Models\Immunization;
use App\Models\MentalHealth;
use App\Models\Center;
use App\Models\Allergies;
use App\Models\Allergy_symptoms;
use App\Models\City;
use App\Models\Condition;
use App\Models\DoctorCenter;
use App\Models\Exam;
use App\Models\Medicines;
use App\Models\Medicines_vias;
use App\Models\ExamPatient;
use App\Models\FamilyBackground;
use App\Models\GeneralStatistic;
use App\Models\History;
use App\Models\Laboratory;
use App\Models\Patient;
use App\Models\State;
use App\Models\MedicalRecord;
use App\Models\MedicalReport;
use App\Models\MedicalDevice;
use App\Models\Mes;
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
use App\Http\Controllers\ErrorController;


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
        if ($value == 'corporate_medico') {
			return 'register corporate medico';
		}
        if ($value == 'corporate_plan') {
			return 'add register corporate plane';
		}
        if ($value == '34') {
			return 'update patient';
		}
        if ($value == '35') {
			return 'update representative';
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
					'name' 		              => $request->name,
					'last_name'               => $request->last_name,
					'ci' 		              => $request->ci,
					'birthdate'               => $request->birthdate,
					'genere'                  => $request->genere,
					'specialty'               => $specialty,
					'age' 		              => $request->age,
					'phone' 	              => $request->phone,
					'state' 	              => $request->state_contrie,
					'city' 		              => $request->city_contrie,
					'contrie' 		          => $request->contrie,
					'address' 	              => $request->address,
					'zip_code' 	              => $request->zip_code,
					'cod_mpps' 	              => $request->cod_mpps,
					'number_floor' 	          => $request->number_floor,
					'number_consulting_room'  => $request->number_consulting_room,
					'number_consulting_phone' => $request->number_consulting_phone,
					'social_media'            => $request->social_media,
					'background_pdf'          => $request->background_pdf,
					'user_img' 	              => $nameFile,
					'status_register'         => '2',
				]);
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.update_registro()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
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
					'rif'             => $request->rif,
					'state'           => $request->state,
					'city'            => $request->city,
					'address'         => $request->address,
					'phone_1'         => $request->phone_1,
					'phone_2'         => $request->phone_2,
					'lab_img'         => $nameFile,
					'status_register' => '2',
				]);
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.update_registro_laboratory()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

	static function get_cities()
	{
		try {
			$cities = City::all();
			return $cities;
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_cities()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

	static function get_states()
	{
		try {
			$states = State::all();
			return $states;
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_states()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

	static function get_patients($id=null)
	{
		try {

			$patients = Patient::where("contrie_doc", $id)->get();

			return $patients;
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_patients()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

	static function get_appointments($id)
	{

        try {
			$appointments = Appointment::where('user_id', $id)->get();

			$data = [];

			foreach ($appointments as $key => $val) {
                $hora = '';

                if ($val->hour_start) {
                    $hora = substr($val->hour_start, 6);
                }

                if (substr($val->hour_start, 6) == '13:00 pm') {
                    $hora = '01:00 pm';
                }

                if (substr($val->hour_start, 6) == '14:00 pm') {
                    $hora = '02:00 pm';
                }

                if (substr($val->hour_start, 6) == '15:00 pm') {
                    $hora = '03:00 pm';
                }

                if (substr($val->hour_start, 6) == '16:00 pm') {
                    $hora = '04:00 pm';
                }

                if (substr($val->hour_start, 6) == '17:00 pm') {
                    $hora = '05:00 pm';
                }

                if (substr($val->hour_start, 6) == '18:00 pm') {
                    $hora = '06:00 pm';
                }

                if (substr($val->hour_start, 6) == '19:00 pm') {
                    $hora = '07:00 pm';
                }

                if (substr($val->hour_start, 6) == '20:00 pm') {
                    $hora = '08:00 pm';
                }

				$data[$key] = [
					'id'            => $val->id,
					'title'         => $hora . " - " . $val->get_patients->name . " " . $val->get_patients->last_name,
					'start'         => date("Y-m-d", strtotime($val->date_start)) . " " . substr($val->hour_start, 0, -9),
					'end'           => date("Y-m-d", strtotime($val->date_start)) . " " . substr($val->hour_start, 6, -3),
					'rendering'     => 'background',
					'color'         => $val->color,
					'extendedProps' => [
						'id'              => $val->id,
						'price'           => $val->price,
						'confirmation'    => $val->confirmation,
                        'is_minor'        => $val->get_patients->is_minor,
						'phone'           => $val->get_patients->phone == null ? '' : $val->get_patients->phone,
						'name'            => $val->get_patients->name,
						'last_name'       => $val->get_patients->last_name,
						'ci'              => $val->get_patients->ci == null ? '' : $val->get_patients->ci,
                        're_ci'           => $val->get_patients->re_ci == null ? '' : $val->get_patients->re_ci,
						'email'           => $val->get_patients->email == null ? '' : $val->get_patients->email,
						'genere'          => $val->get_patients->genere == null ? '' : $val->get_patients->genere,
						'age'             => $val->get_patients->age,
						'patient_id'      => $val->get_patients->id,
						'center_id'       => $val->center_id,
						'center'          => $val->get_center->description,
						'data'            => substr($val->hour_start, 0, -3),
						'img'             => $val->get_patients->patient_img,
						'data_app'        => $val->date_start,
						'time_zone_start' => substr($val->hour_start, 12),
                        'status'          => $val->get_status->description,
						'status_class'    => $val->get_status->class,
					],
				];
			}
			return $data;
			//code...
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_appointments()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

    static function get_appointments_dashboard($id)
	{
		try {
			$appointments = Appointment::where('user_id', $id)->where('date_start', date('Y-m-d'))->get();

			$data = [];

			foreach ($appointments as $key => $val) {
                $hora = '';

                if ($val->hour_start) {
                    $hora = substr($val->hour_start, 6);
                }

                if (substr($val->hour_start, 6) == '13:00 pm') {
                    $hora = '01:00 pm';
                }

                if (substr($val->hour_start, 6) == '14:00 pm') {
                    $hora = '02:00 pm';
                }

                if (substr($val->hour_start, 6) == '15:00 pm') {
                    $hora = '03:00 pm';
                }

                if (substr($val->hour_start, 6) == '16:00 pm') {
                    $hora = '04:00 pm';
                }

                if (substr($val->hour_start, 6) == '17:00 pm') {
                    $hora = '05:00 pm';
                }

                if (substr($val->hour_start, 6) == '18:00 pm') {
                    $hora = '06:00 pm';
                }

                if (substr($val->hour_start, 6) == '19:00 pm') {
                    $hora = '07:00 pm';
                }

                if (substr($val->hour_start, 6) == '20:00 pm') {
                    $hora = '08:00 pm';
                }

				$data[$key] = [
					'id'            => $val->id,
					'title'         => $hora . " - " . $val->get_patients->name . " " . $val->get_patients->last_name,
                    'start'         => date("Y-m-d", strtotime($val->date_start)) . " " . substr($val->hour_start, 0, -9),
					'end'           => date("Y-m-d", strtotime($val->date_start)) . " " . substr($val->hour_start, 6, -3),
					'rendering'     => 'background',
					'color'         => $val->color,
					'extendedProps' => [
						'id'              => $val->id,
						'price'           => $val->price,
						'confirmation'    => $val->confirmation,
						'is_minor'        => $val->get_patients->is_minor,
						'phone'           => $val->get_patients->phone == null ? '' : $val->get_patients->phone,
						'name'            => $val->get_patients->name,
						'last_name'       => $val->get_patients->last_name,
						'ci'              => $val->get_patients->ci == null ? '' : $val->get_patients->ci,
						're_ci'           => $val->get_patients->re_ci == null ? '' : $val->get_patients->re_ci,
						'email'           => $val->get_patients->email == null ? '' : $val->get_patients->email,
						'genere'          => $val->get_patients->genere == null ? '' : $val->get_patients->genere,
						'age'             => $val->get_patients->age,
						'patient_id'      => $val->get_patients->id,
						'center_id'       => $val->center_id,
						'center'          => $val->get_center->description,
						'data'            => substr($val->hour_start, 0, -3),
						'img'             => $val->get_patients->patient_img,
						'data_app'        => $val->date_start,
						'time_zone_start' => substr($val->hour_start, 12),
						'status'          => $val->get_status->description,
						'status_class'    => $val->get_status->class,
					],
				];
			}

			return $data;
			//code...
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_appointments_dashboard()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

	static function get_history($id)
	{
		try {
			$history = History::where('id', $id)->get();
			return $history;
			//code...
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_history()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

	// static function get_patients_pag()
	// {
	// 	try {
	// 		$patients = [];
	// 		$patients_pagination = MedicalRecord::all()->unique('patient_id');
	// 		foreach ($patients_pagination as $key => $val) {
	// 			$patients[$key] = [
	// 				'id' 			     => $val->get_patient->id,
	// 				'name' 			     => $val->get_patient->name . ' ' . $val->get_patient->last_name,
	// 				// 'last_name' 	     => $val->get_patient->last_name,
	// 				'patient_code' 	     => $val->get_patient->patient_code,
	// 				'ci' 			     => $val->get_patient->ci,
	// 				'ci_table' 		     => ($val->get_patient->is_minor == "true") ? $val->get_patient->get_reprensetative->re_ci . '  (Rep)' : $val->get_patient->ci,
	// 				'birthdate' 	     => $val->get_patient->birthdate,
	// 				'genere' 		     => $val->get_patient->genere,
	// 				'phone_table' 	     => ($val->get_patient->is_minor === 'true') ? $val->get_patient->get_reprensetative->re_phone . '  (Rep)' : $val->get_patient->phone,
	// 				'phone' 		     => $val->get_patient->phone,
	// 				'email_table' 	     => ($val->get_patient->is_minor === 'true') ? $val->get_patient->get_reprensetative->re_email . '  (Rep)' : $val->get_patient->email,
	// 				'email' 		     => $val->get_patient->email,
	// 				'address' 		     => $val->get_patient->address,
	// 				'patient_img' 	     => $val->get_patient->patient_img,
	// 				'is_minor'		     => $val->get_patient->is_minor,
	// 				'state'			     => $val->get_patient->state,
	// 				'city'			     => $val->get_patient->city,
	// 				'profession'	     => $val->get_patient->profession,
	// 				'center_id' 	     => $val->get_patient->center_id,
	// 				'zip_code' 		     => $val->get_patient->zip_code,
	// 				'get_reprensetative' => $val->get_patient->get_reprensetative,
	// 			];
	// 		}
	// 		return $patients;
	// 		//code...
	// 	} catch (\Throwable $th) {
	// 		$error_log = $th->getMessage();
    //         $modulo = 'UtilsController.get_patients_pag()';
    //         ErrorController::error_log($modulo, $error_log);
    //         return view('error404');
	// 	}
	// }

	static function get_doctor_centers_pag()
	{
		try {
			$doctor_centers = DoctorCenter::all();
			return $doctor_centers;
			//code...
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_doctor_centers_pag()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

	static function get_medical_record()
	{
		try {
			$MedicalRecord = MedicalRecord::where('user_id', Auth::user()->id)->get();
			return $MedicalRecord;
			//code...
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_medical_record()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

	static function get_medical_record_user($id)
	{
		try {
            $medical_record_user = [];
            //Sin drogas....
            $medical_user = MedicalRecord::where('patient_id', $id)->with(['get_paciente', 'get_doctor', 'get_center'])->get();

            return $medical_user;
        } catch (\Throwable $th) {
            $error_log = $th->getMessage();
            $modulo = 'UtilsController.get_medical_record_user()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
        }


	}

	static function get_doctor_centers()
	{
		try {
			$doctor_centers = [];
			$dataCenters = DoctorCenter::where('user_id', Auth::user()->id)->get();
			foreach ($dataCenters as $key => $val) {
				$doctor_centers[$key] = [
					'id'                     => $val->id,
					'center'                 => $val->get_center->description,
					'address'                => $val->address,
					'building_house'         => $val->building_house,
					'number_floor'           => $val->number_floor,
					'phone_consulting_room'  => $val->phone_consulting_room,
					"number_consulting_room" => $val->number_consulting_room,
					"status"                 => $val->status,
				];
			}
			return $doctor_centers;
			//code...
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_doctor_centers()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

	static function get_one_patient($id)
	{
		try {
			$Patient = Patient::where('id', $id)->first();
			return $Patient;
			//code...
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_one_patient()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

	static function get_centers()
	{
		try {

			$centers = Center::where('corporate', 'false')->get();
			return $centers;
			//code...
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_centers()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

	static function get_centers_state($state)
	{
		try {

			$centers = Center::where('state', $state)->get();
			return $centers;
			//code...
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_centers_state()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
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
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.notification_register_mail()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
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
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.notification_mail()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
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
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.verify_email()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
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
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.patient_verify_email()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
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
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.notification_dairy_email()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

	static function get_patient_history($id)
	{
		try {

			$patient_history = History::where('id', $id)->get();

			return $patient_history;
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_patient_history()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

	static function get_history_vital_sing()
	{
		try {

			$VitalSign = VitalSign::all();

			return $VitalSign;
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_history_vital_sing()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

	static function get_history_family_back()
	{
		try {

			$family_back = FamilyBackground::all();

			return $family_back;
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_history_family_back()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

    static function get_allergies()
	{
		try {

			$family_back = Allergies::all();

			return $family_back;
		} catch (\Throwable $th) {
			$$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_allergies()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

    static function get_allergy_symptoms()
	{
		try {

			$family_back = Allergy_symptoms::all();

			return $family_back;
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_allergy_symptoms()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

	static function get_history_pathology_back()
	{
		try {

			$pathology_back = PathologicalBackground::all();

			return $pathology_back;
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_history_pathology_back()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

	static function get_history_non_pathology_back()
	{
		try {

			$non_pathology_back = NonPathologicalBackground::all();

			return $non_pathology_back;
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_history_non_pathology_back()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

    static function get_inmunizations()
	{
		try {

			$inmunizations = Immunization::all();

			return $inmunizations;
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_inmunizations()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

    static function get_mental_healths()
	{
		try {

			$mental_healths = MentalHealth::all();

			return $mental_healths;
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_mental_healths()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

	static function get_condition()
	{
		try {

			$Condition = Condition::all();

			return $Condition;
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_condition()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

	static function get_image_patient($imgen)
	{

		try {
			$file = Storage::disk('app/img/')->get($imgen);
			return $file;
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_image_patient()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

	static function get_patient_code($ci)
	{
		try {

			$patient_code = 'SQ-' . $ci . '-' . random_int(111, 999);

			return $patient_code;
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_patient_code()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
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
	static function get_patient_boy_girl($id)
	{
		try {
			$patient_genere_femenino =  Patient::where('user_id', $id)->where('genere', '=', 'femenino')
				->where('age', '<=', 12)
				->count();

			$patient_genere_masculino  =  Patient::where('user_id', $id)->where('genere', '=', 'masculino')
				->where('age', '<=', 12)
				->count();

			return ["femenino" => $patient_genere_femenino, 'masculino' => $patient_genere_masculino];
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_patient_boy_girl()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

    static function get_all_patient_boy_girl($id)
	{
		try {
			$patient_boy_girl =  Patient::where('user_id', $id)
				->where('age', '<=', 12)
				->count();

			return $patient_boy_girl;
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_all_patient_boy_girl()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

	/**
	 * Jovenes
	 */
    static function get_patient_teen($id)
	{
		try {
			$patient_genere_femenino = Patient::where('user_id', $id)->where('genere', '=', 'femenino')
				->WhereBetween('age', ['12', '17'])
				->count();

			$patient_genere_masculino = Patient::where('user_id', $id)->where('genere', '=', 'masculino')
				->WhereBetween('age', ['12', '17'])
				->count();
			return ["femenino" => $patient_genere_femenino, 'masculino' => $patient_genere_masculino];
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_patient_teen()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

    static function get_all_patient_teen($id)
	{
		try {
			$patient_teen =  Patient::where('user_id', $id)
				->WhereBetween('age', [12, 17])
				->count();

			return $patient_teen;
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_all_patient_teen()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

	/**
	 * Adultos
	 */
	static function get_patient_adult($id)
	{
		try {
			$patient_genere_femenino =  Patient::where('user_id', $id)->where('genere', '=', 'femenino')
				->WhereBetween('age', ['19', '60'])
				->count();
			$patient_genere_masculino =  Patient::where('user_id', $id)->where('genere', '=', 'masculino')
				->WhereBetween('age', ['19', '60'])
				->count();
			return ["femenino" => $patient_genere_femenino, 'masculino' => $patient_genere_masculino];
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_patient_adult()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

    static function get_all_patient_adult($id)
	{
		try {
			$patient_adult =  Patient::where('user_id', $id)
            ->WhereBetween('age', [19, 60])
			->count();

			return $patient_adult;
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_all_patient_adult()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

	/**
	 * Adulto mayor
	 */
	static function get_patient_elderly($id)
	{
		try {
            $patient_genere_femenino =  Patient::where('user_id', $id)->where('genere', '=', 'femenino')
            ->where('age', '>', 61)
            ->count();

			$patient_genere_masculino =  Patient::where('user_id', $id)->where('genere', '=', 'masculino')
            ->where('age', '>', 61)
            ->count();

			return ["femenino" => $patient_genere_femenino, 'masculino' => $patient_genere_masculino];
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_patient_elderly()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

    static function get_all_patient_elderly($id)
	{
		try {
			$patient_elderly =  Patient::where('user_id', $id)
            ->where('age', '>', 61)
			->count();

			return $patient_elderly;
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_all_patient_elderly()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

    static function get_all_patient_gender($id)
	{
		try {
			$patient_genere_femenino =  Patient::where('user_id', $id)->where('genere', '=', 'femenino')
				->count();

			$patient_genere_masculino  =  Patient::where('user_id', $id)->where('genere', '=', 'masculino')
				->count();

			return ["femenino" => $patient_genere_femenino, 'masculino' => $patient_genere_masculino];
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_all_patient_gender()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
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

            $dairy = Appointment::where('code', $code)->where('status', 2)->first();

            /**Logica para guardar el acumulado de citas confirmadas por el paciente */
            EstadisticaController::accumulated_dairy_confirmada($dairy->user_id, $dairy->center_id);

			return view('welcome');

		} catch (\Throwable $th) {

		}
	}

    /**
	 * Confirmacion de cita por parte del paciente
	 * @param code de la cita
	 */
	static function cancelation_dairy($code)
	{
		try {

			$update = DB::table('appointments')
				->where('code', $code)
				->update([
					'status' => 4,
				]);

            $dairy = Appointment::where('code', $code)->where('status', 4)->first();

            /**Logica para guardar el acumulado de citas confirmadas por el paciente */
            EstadisticaController::accumulated_dairy_confirmada($dairy->user_id, $dairy->center_id);

			return view('cancel');

		} catch (\Throwable $th) {

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
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.notification_ref_email()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

	static function get_image_lab($lab_email)
	{
		try {

			$lab_img = Laboratory::where('email', $lab_email)->first();
			$img = $lab_img->lab_img;
			return $img;
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_image_lab()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
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
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.exit_image_lab()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

	static function get_ref()
	{
		try {

			$reference = Reference::all();
			return $reference;
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_ref()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

	static function get_all_ref()
	{
		try {
			$references = [];
			$reference = Reference::all();
			foreach ($reference as $key => $val) {
				$references[$key] = [
					'id' 			     => $val->id,
					'date' 			     => $val->date,
					'cod_ref' 	         => $val->cod_ref,
					'cod_medical_record' => $val->cod_medical_record,
					'name' 		         => $val->get_patient->name . ' ' . $val->get_patient->last_name,
					'ci' 		         => $val->get_patient->ci,
					'genere' 		     => $val->get_patient->ci,
					'phone' 		     => $val->get_patient->ci,
					'get_exam'           => $val->get_exam,
					'get_studie'         => $val->get_studie,
				];
			}

			// dd($references);

			return $references;
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_all_ref()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
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
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.upload_result_exam()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
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
							'file'           => $nameFile,
							'status'         => 2,
							'date_result'    => date('d-m-Y'),
						]);
				} else {

					$update = DB::table('study_patients')
						->where('cod_ref', $data->code_ref)
						->where('cod_study', $data_studies[$i]->cod_study)
						->update([
							'laboratory_id' => $laboratory->id,
							'cod_lab'       => $laboratory->code_lab,
							'file'          => $nameFile,
							'status'        => 2,
							'date_result'   => date('d-m-Y'),
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
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.upload_result_study()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

	static function get_description_exam($code)
	{
		try {
			$description = Exam::where('cod_exam', $code)->first();
			return $description->description;
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_description_exam()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

	static function get_description_study($code)
	{
		try {
			$description = Study::where('cod_study', $code)->first();
			return $description->description;
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_description_study()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

	static function update_patient_counter($user_id)
	{
		try {

                $value = User::where('id', $user_id)->first();
                $counter = DB::table('users')
                    ->where('id', $user_id)
                    ->update([
                        'patient_counter' => $value->patient_counter + 1,
                    ]);

		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.update_patient_counter()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
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
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.update_patient_counter()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
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
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.update_patient_counter()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

	static function get_table_medical_record($id)
	{
		try {

			$user = Auth::user();
			// MedicalRecord::where('user_id', $user->id)->get()->unique('patient_id');

            $user_id = (Auth::user()->role=="secretary") ? Auth::user()->master_corporate_id : $id;

			$medical_record = Patient::where('user_id', $user_id)
				->with('get_patient_medical_record')->get();

			return $medical_record;
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_table_medical_record()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

	// static function search_person($value, $row)
	// {
    //     try {

    //         $data = [];

    //         if ($row != 'cod_ref') {

    //             $pat = Patient::where("ci", $value)
    //                 ->orwhereHas('get_reprensetative', function ($q) use ($value) {
    //                     $q->where('re_ci', $value);
    //                 })->get();

    //             $tablePat =  ExamPatient::where('status', 2)
    //                 ->whereHas('get_patients', function ($q) use ($value) {
    //                     $q->where('ci', $value);
    //                 });

    //             $tableRep =  ExamPatient::where('status', 2)
    //                 ->whereHas('get_patients', function ($q) use ($value) {
    //                     $q->whereHas('get_reprensetative', function ($q) use ($value) {
    //                         $q->where('re_ci', $value);
    //                     });
    //                 });

    //             $data = $tablePat->union($tableRep)
    //                 ->with(['get_laboratory', 'get_patients', 'get_reprensetative'])
    //                 ->skip(0)     // punto de partida
    //                 ->take(10)   // limite de resgistro
    //                 ->get();

    //             $count =  $tablePat->union($tableRep)->get();

    //             $data = [
    //                 "data"  => $data,
    //                 "count" => count($count),
    //                 "skip"  => 0,
    //                 "limit" => 10,
    //             ];

    //             ///buscar las referencias sin resultados cargados

    //             $Reference_pat =  Reference::whereHas('get_patient', function ($q) use ($value) {
    //                 $q->where('ci', $value);
    //             });

    //             $Reference_reo =  Reference::whereHas('get_patient', function ($q) use ($value) {
    //                 $q->whereHas('get_reprensetative', function ($q) use ($value) {
    //                     $q->where('re_ci', $value);
    //                 });
    //             });



    //             $reference = $Reference_pat->union($Reference_reo)
    //                 ->with(['get_patient', 'get_examne_stutus_uno', 'get_reprensetative'])
    //                 ->skip(0)     // punto de partida
    //                 ->take(10)   // limite de resgistro
    //                 ->get();

    //             $countDos = $Reference_pat->union($Reference_reo)->get();

    //             $reference = [
    //                 "data"  => $reference,
    //                 "count" => count($countDos),
    //                 "skip"  => 0,
    //                 "limit" => 10,
    //             ];

    //             return ["data" => $data, "reference" => $reference, "pat" => $pat];
    //         } else {

    //             $tablePat =  Reference::whereHas('get_patient', function ($q) use ($value) {
    //                 $q->where('ci', $value);
    //             });

    //             $tableRep =  Reference::whereHas('get_patient', function ($q) use ($value) {
    //                 $q->whereHas('get_reprensetative', function ($q) use ($value) {
    //                     $q->where('re_ci', $value);
    //                 });
    //             });

    //             $reference = $tablePat->union($tableRep)->get();

    //             foreach ($reference as $key => $val) {
    //                 $data[$key] = [
    //                     'id'                 => $val->id,
    //                     'cod_ref'            => $val->cod_ref,
    //                     'date'               => $val->date,
    //                     'cod_medical_record' => $val->cod_medical_record,
    //                     'get_exam'           => $val->get_exam,
    //                     'get_studie'         => $val->get_studie,
    //                     'get_patient'        => $val->get_patient,
    //                 ];
    //             }

    //             return $data;
    //         }

    //     } catch (\Throwable $th) {
    //         $error_log = $th->getMessage();
    //         $modulo = 'UtilsController.search_person()';
    //         ErrorController::error_log($modulo, $error_log);
    //         return view('error404');
    //     }

	// }

	// static function search_studio($value, $row)
	// {
    //     try {

    //         $data = [];
    //         if ($row != 'cod_ref') {

    //             $pat = Patient::where("ci", $value)
    //                 ->orwhereHas('get_reprensetative', function ($q) use ($value) {
    //                     $q->where('re_ci', $value);
    //                 })->get();

    //             $tablePat =  StudyPatient::where('status', 2)
    //                 ->whereHas('get_patient', function ($q) use ($value) {
    //                     $q->where('ci', $value);
    //                 });

    //             $tableRep =  StudyPatient::where('status', 2)
    //                 ->whereHas('get_patient', function ($q) use ($value) {
    //                     $q->whereHas('get_reprensetative', function ($q) use ($value) {
    //                         $q->where('re_ci', $value);
    //                     });
    //                 });

    //             $data = $tablePat->union($tableRep)
    //                 ->with(['get_laboratory', 'get_patient', 'get_reprensetative'])
    //                 ->skip(0)     // punto de partida
    //                 ->take(10)   // limite de resgistro
    //                 ->get();

    //             $count = $data = $tablePat->union($tableRep)->get();

    //             $data = [
    //                 "data"  => $data,
    //                 "count" => count($count),
    //                 "skip"  => 0,
    //                 "limit" => 10,
    //             ];

    //             //buscar las referencias sin resultados cargados

    //             $Reference_pat =  Reference::whereHas('get_patient', function ($q) use ($value) {
    //                 $q->where('ci', $value);
    //             });

    //             $Reference_reo =  Reference::whereHas('get_patient', function ($q) use ($value) {
    //                 $q->whereHas('get_reprensetative', function ($q) use ($value) {
    //                     $q->where('re_ci', $value);
    //                 });
    //             });

    //             $reference = $Reference_pat->union($Reference_reo)
    //                 ->with(['get_patient', 'get_estudio_stutus_uno', 'get_reprensetative'])
    //                 ->skip(0)     // punto de partida
    //                 ->take(10)   // limite de resgistro
    //                 ->get();

    //             $countDos = $Reference_pat->union($Reference_reo)->get();

    //             $reference = [
    //                 "data"  => $reference,
    //                 "count" => count($countDos),
    //                 "skip"  => 0,
    //                 "limit" => 10,
    //             ];

    //             return ["data" => $data, "reference" => $reference, "pat" => $pat];
    //         }
    //         //code...
    //     } catch (\Throwable $th) {
    //         $error_log = $th->getMessage();
    //         $modulo = 'UtilsController.search_studio()';
    //         ErrorController::error_log($modulo, $error_log);
    //         return view('error404');
    //     }

	// }

	static function responce_references()
	{
        try {

            $data_exam_res = ComponentsLaboratory::res_exams();

            $data_study_res = ComponentsLaboratory::res_studies();

            return ["data_exam_res" => $data_exam_res, "data_study_res" => $data_study_res];

        } catch (\Throwable $th) {
            $error_log = $th->getMessage();
            $modulo = 'UtilsController.responce_references()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
        }
	}

	static function update_status_dairy($id)
	{
		try {
			$user_id = Auth::user()->id;
			$appointments = Appointment::where('user_id', $user_id)->where('id', $id)
				->update([
					'status' => 3,
				]);
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.update_status_dairy()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
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
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.total_exams()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
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
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.total_studies()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

	static function get_counter()
	{
		try {

			$user_patient_counter = Auth::user()->patient_counter;
			return $user_patient_counter;
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_counter()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
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
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_patient_corporate()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

	static function get_medical_record_corporate()
	{
		try {

			$user = Auth::user();
			$lista_medical_record = MedicalRecord::where('center_id', $user->center_id)->get();
			return $lista_medical_record;
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_medical_record_corporate()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

	static function get_doctor_corporate()
	{
		try {

			$user = Auth::user();
			$lista_doctor = User::where('master_corporate_id', $user->id)->where('role', 'medico')->get();
			return $lista_doctor;
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_doctor_corporate()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

	static function get_list_exam()
	{
		try {

			$list_exam = Exam::all();
			return $list_exam;
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_list_exam()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

	static function get_list_study()
	{
		try {

			$list_study = Study::all();
			return $list_study;
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_list_study()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

	static function habilitar_doctor_corporate($id)
	{
		try {

			$doctor = User::where('id', $id)
			->where('type_plane', 7)
			->update([
					'tipo_status' => '1'
				]);

			$doctor_update = UtilsController::get_doctor_corporate();

			$info_doctor = User::where('id', $id)->where('type_plane', '7')->first();
			$type = 'enable_doc';
			$mailData = [
				'dr_name'  => $info_doctor->name . ' ' . $info_doctor->last_name,
				'dr_email' => $info_doctor->email,
				'center'   => Center::where('id', $info_doctor->center_id)->first()->description
			];

			UtilsController::notification_mail($mailData, $type);

			return $doctor_update;
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.habilitar_doctor_corporate()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

	static function deshabilitar_doctor_corporate($id)
	{

		try {

			$doctor = User::where('id', $id)
				->where('type_plane', 7)
				->update([
					'tipo_status' => '2'
				]);

			$doctor_update = UtilsController::get_doctor_corporate();

			$info_doctor = User::where('id', $id)->where('type_plane', '7')->first();

			$type = 'disable_doc';
			$mailData = [
				'dr_name'  => $doctor_update->name . ' ' . $doctor_update->last_name,
				'dr_email' => $doctor_update->email,
				'center'   => Center::where('id', $doctor_update->center_id)->first()->description
			];

			UtilsController::notification_mail($mailData, $type);

			return $doctor_update;
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.deshabilitar_doctor_corporate()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
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
				'Content-Type'  => 'application/json',
				'Accept'        => 'application/json',
				'Authorization' => $secret_key,
			])
				->post("https://api.openai.com/v1/chat/completions", [
					"model" => "gpt-3.5-turbo",
					'messages' => [
						[
							"role"    => "user",
							"content" => "Actua como medico y realiza un diagnostico para un paciente " . $request->genere . " de " . $request->age . " años con los siguientes sintomas: " . $request->symtoms . ". Agrega 3 recomendaciones generales y recomienda 3 examenes medicos."
						]
					],
					'temperature'       => 1,
					"max_tokens"        => 1024,
					"n"                 => 1,
					"stream"            => false,
					"top_p"             => 1,
					"frequency_penalty" => 0,
					"presence_penalty"  => 0,
				]);

			$res = $data->json()['choices'][0]['message']['content'];

			return response()->json([
				'success' => 'true',
				'data'    =>  $res
			], 200);
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.sqlapio_ia()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

	static function get_medical_report($id)
	{
		try {
			$medical_report = MedicalReport::where('patient_id', $id)->with('get_doctor')->orderBy('date', 'desc')->get();
			return $medical_report;
			//code...
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_medical_report()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
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
            $error_log = $th->getMessage();
            $modulo = 'UtilsController.color_dairy()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
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
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.generete_pass()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

	static function get_queries_month($month = null,$id)
	{
		try {

            $labels = Mes::where('numero', '<=', now()->format('m'))->pluck('mes')->toArray();

            $valores = [];

            for($i=0; $i < count($labels); $i++){
                $valor = GeneralStatistic::where('mes', $labels[$i])->where('user_id', Auth::user()->id)->sum('medical_record');
                if(isset($valor)){
                    array_push($valores, $valor);
                }
            }

            return $valores;

        } catch (\Throwable $th) {
            $error_log = $th->getMessage();
            $modulo = 'UtilsController.get_queries_month()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
        }
	}

    static function meses()
    {
        try {

            $meses = Mes::where('numero', '<=', now()->format('m'))->pluck('mes')->toArray();

            return $meses;

        } catch (\Throwable $th) {
            $error_log = $th->getMessage();
            $modulo = 'UtilsController.meses()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
        }
    }

	static function get_appointments_attended($month = null,$id)
	{
		try {

			$labels = Mes::where('numero', '<=', now()->format('m'))->pluck('mes')->toArray();

            $valores = [];

            /**
             * Este if() se utiliza para diferenciar cuando
             * el usuario que esta logeado es un medico o su secretaria
             */
            if(Auth::user()->master_corporate_id != null)
            {
                $search_id = Auth::user()->master_corporate_id;
            }else{
                $search_id = Auth::user()->id;
            }
            /************************************************************/

            for($i=0; $i < count($labels); $i++){
                $valor = GeneralStatistic::where('mes', $labels[$i])->where('user_id', $search_id)->sum('dairy_finalizada');

                if(isset($valor)){
                    array_push($valores, $valor);
                }
            }

            return $valores;

		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_appointments_attended()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

	static function get_appointments_canceled($month = null,$id)
	{
		try {

			$labels = Mes::where('numero', '<=', now()->format('m'))->pluck('mes')->toArray();

            $valores = [];

            /**
             * Este if() se utiliza para diferenciar cuando
             * el usuario que esta logeado es un medico o su secretaria
             */
            if(Auth::user()->master_corporate_id != null)
            {
                $search_id = Auth::user()->master_corporate_id;
            }else{
                $search_id = Auth::user()->id;
            }
            /************************************************************/

            for($i=0; $i < count($labels); $i++){
                $valor = GeneralStatistic::where('mes', $labels[$i])->where('user_id', $search_id)->sum('dairy_cancelada');

                if(isset($valor)){
                    array_push($valores, $valor);
                }
            }

            return $valores;

		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_appointments_canceled()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

	static function get_appointments_confirmed($month = null,$id)
	{
		try {

            $labels = Mes::where('numero', '<=', now()->format('m'))->pluck('mes')->toArray();

            $valores = [];

            /**
             * Este if() se utiliza para diferenciar cuando
             * el usuario que esta logeado es un medico o su secretaria
             */
            if(Auth::user()->master_corporate_id != null)
            {
                $search_id = Auth::user()->master_corporate_id;
            }else{
                $search_id = Auth::user()->id;
            }
            /************************************************************/

            for($i=0; $i < count($labels); $i++){
                $valor = GeneralStatistic::where('mes', $labels[$i])->where('user_id', $search_id)->sum('dairy_confirmar');

                if(isset($valor)){
                    array_push($valores, $valor);
                }
            }

            return $valores;

		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_appointments_confirmed()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

    /**
     * Citas Agendadas
     */
    static function get_appointments_unconfirmed($month = null,$id)
	{

		try {

            $labels = Mes::where('numero', '<=', now()->format('m'))->pluck('mes')->toArray();

            $valores = [];

            /**
             * Este if() se utiliza para diferenciar cuando
             * el usuario que esta logeado es un medico o su secretaria
             */
            if(Auth::user()->master_corporate_id != null)
            {
                $search_id = Auth::user()->master_corporate_id;
            }else{
                $search_id = Auth::user()->id;
            }
            /************************************************************/

            for($i=0; $i < count($labels); $i++){
                $valor = GeneralStatistic::where('mes', $labels[$i])->where('user_id', $search_id)->sum('dairy_sin_confirmar');

                if(isset($valor)){
                    array_push($valores, $valor);
                }
            }
            // dd($valores);
            return $valores;

		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_appointments_unconfirmed()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

    /**
     * Citas Agendadas para el plan corporativo
     */
    static function get_appointments_unconfirmed_master_corporate()
	{

		try {

            $labels = Mes::where('numero', '<=', now()->format('m'))->pluck('mes')->toArray();

            $valores = [];

            for($i=0; $i < count($labels); $i++){
                $valor = GeneralStatistic::where('mes', $labels[$i])->where('type_plane', 7)->count();

                if(isset($valor)){
                    array_push($valores, $valor);
                }
            }

            return $valores;

		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_appointments_unconfirmed()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

    static function get_appointments_not_attended($month = null,$id)
	{
		try {

			$labels = Mes::where('numero', '<=', now()->format('m'))->pluck('mes')->toArray();

            $valores = [];

            /**
             * Este if() se utiliza para diferenciar cuando
             * el usuario que esta logeado es un medico o su secretaria
             */
            if(Auth::user()->master_corporate_id != null)
            {
                $search_id = Auth::user()->master_corporate_id;
            }else{
                $search_id = Auth::user()->id;
            }
            /************************************************************/

            for($i=0; $i < count($labels); $i++){
                $valor = GeneralStatistic::where('mes', $labels[$i])->where('user_id', $search_id)->sum('dairy_no_atendida');

                if(isset($valor)){
                    array_push($valores, $valor);
                }
            }

            return $valores;

		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_appointments_not_attended()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

	static function get_appointments_count_all_attended($id)
	{
		try {

			$attended = GeneralStatistic::where("user_id", $id)->get()->sum('dairy_finalizada');

			return $attended;

		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_appointments_count_all_attended()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

    static function get_appointments_count_all_canceled($id)
	{
		try {

			$canceled = GeneralStatistic::where("user_id", $id)->get()->sum('dairy_cancelada');

			return $canceled;

		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_appointments_count_all_canceled()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

    static function get_appointments_count_all_confirmada($id)
	{
		try {

			$confirmada = GeneralStatistic::where("user_id", $id)->get()->sum('dairy_confirmar');

			return $confirmada;

		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_appointments_count_all_confirmada()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

    static function get_appointments_count_all_no_atendida($id)
	{
		try {

			$no_atendida = GeneralStatistic::where("user_id", $id)->get()->sum('dairy_no_atendida');

			return $no_atendida;

		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_appointments_count_all_no_atendida()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

	static function filter_month_dashboard($month)
	{
		try {

			$id= (Auth::user()->role=="secretary")?Auth::user()->master_corporate_id :Auth::user()->id;

			$get_queries_month = UtilsController::get_queries_month($month,$id);
			$get_appointments_attended = UtilsController::get_appointments_attended($month,$id);
			$get_appointments_canceled = UtilsController::get_appointments_canceled($month,$id);
			$get_appointments_confirmed = UtilsController::get_appointments_confirmed($month,$id);
			$get_appointments_unconfirmed = UtilsController::get_appointments_unconfirmed($month,$id);

			return [
				'get_queries_month'            => $get_queries_month,
				'get_appointments_attended'    => $get_appointments_attended,
				'get_appointments_canceled'    => $get_appointments_canceled,
				'get_appointments_confirmed'   => $get_appointments_confirmed,
				'get_appointments_unconfirmed' => $get_appointments_unconfirmed,
			];
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.filter_month_dashboard()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}


	static function get_doctor_active()
	{
		try {

			$patientActive = User::where('master_corporate_id', auth()->user()->id)
			->where('tipo_status', 1)
			->where('role', 'medico')->count();

			return $patientActive;
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_doctor_active()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}


	static function get_doctor_inacactive()
	{
		try {

			$patientActive = User::where('master_corporate_id', auth()->user()->id)
			->where('tipo_status', 2)
			->where('role', 'medico')->count();

			return $patientActive;
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_doctor_inacactive()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

    static function get_medicines()
	{
		try {
			$medicines = Medicines::all();
			return $medicines;
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_medicines()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

    static function get_medicines_vias()
	{
		try {
			$medicines_vias = Medicines_vias::all();
			return $medicines_vias;
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_medicines_vias()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

    static function get_medical_device()
	{
		try {
			$medical_device = MedicalDevice::all();
			return $medical_device;
		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_medical_device()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

    static function get_study()
    {
        try {
			$StudyPatient = StudyPatient::where('user_id', Auth::user()->id)->orderBy('date', 'desc')->get();
            // dd($StudyPatient);
			return $StudyPatient;

		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_study()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
    }

    static function get_exam()
    {
        try {
			$ExamPatient = ExamPatient::where('user_id', Auth::user()->id)->orderBy('date', 'desc')->get();
            // dd($StudyPatient);
			return $ExamPatient;

		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_exam()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
    }

    static function delete_file_exam($id)
    {
        try {
            $delete = ExamPatient::where('id', $id)->first()->update([
                'status' => 1,
                'date_result' => null,
                'file' => null
            ]);

            if ($delete) {
                return response()->json([
                    'success' => 'true',
                ], 200);
            }

        } catch (\Throwable $th) {
            $error_log = $th->getMessage();
            $modulo = 'UtilsController.delete_file_exam()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
        }
    }

    static function delete_file_study($id)
    {
        try {
            $delete = StudyPatient::where('id', $id)->first()->update([
                'status' => 1,
                'date_result' => null,
                'file' => null
            ]);

            if ($delete) {
                return response()->json([
                    'success' => 'true',
                ], 200);
            }

        } catch (\Throwable $th) {
            $error_log = $th->getMessage();
            $modulo = 'UtilsController.delete_file_study()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
        }
    }

}
