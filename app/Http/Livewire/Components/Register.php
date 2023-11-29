<?php

namespace App\Http\Livewire\Components;

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\ApiServicesController;
use App\Http\Controllers\EstadisticaController;
use App\Http\Controllers\UtilsController;
use App\Models\BilledPlan;
use App\Models\Laboratory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Livewire\Component;

class Register extends Component {

	public function store(Request $request)
	{
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
        $user = User::where('email', $request->email)->first();

		if($user->role == 'medico')
		{
			$rules = [
				'name'      => 'required',
				'last_name' => 'required',
				'password'  => 'required',
			];

			$msj = [
				'name'              => 'Campo requerido',
				'last_name'         => 'Campo requerido',
				'password'          => 'Campo requerido',
				'password.min'      => 'Contraseña debe ser mayor a 6 caracteres',
				'password.max'      => 'Contraseña debe ser menor a 8 caracteres',
				'password.regex'    => 'Formato de contraseña  incorrecto',
			];

			$validator = Validator::make($request->all(), $rules, $msj);

			if ($validator->fails()) {
				return Redirect::to('/')->withErrors($validator);
			}

			try {

                if($request->doctor_corporate == true)
                {
                    if($user->type_plan != '7')
                    {
                        return response()->json([
                            'error' => 'true',
                            'mjs'  => 'Usted ya se encuentra registrado en SQLAPIO.COM, debe registrarce con correo electrónico distinto.',
                        ], 400);
                    }else{
                        User::where('email', $request->email)
                            ->update([
                                'password' 			=> Hash::make($request->password),
                                'verification_code' => Str::random(30)
                            ]);
                    } 
                }else{
                    User::where('email', $request->email)
                        ->update([
                            'password'             => Hash::make($request->password),
                            'verification_code' => Str::random(30)
                        ]);
                }

			/**
			 * Registro de accion en el log
			 * del sistema
			 */
			$action = '3';
			ActivityLogController::store_log($action);

			/**
			 * Envio de notificacion por correo
			 */
            $user_update = User::where('email', $request->email)->first();
			$type = 'verify_email';
			$mailData = [
				'dr_name' => $request->name.' '.$request->last_name,
				'dr_email' => $request->email,
				'verify_code' => $user_update->verification_code,
			];

			UtilsController::notification_mail($mailData, $type);

			return redirect('/')->with('success', 'El registro inicial satisfactorio');

			} catch (\Throwable $th) {
				$message = $th->getMessage();
				dd('Error Livewire.Components.Register.store()', $message);
			}
		}

		if($user->role == 'laboratorio' || $user->role == 'corporativo')
		{

			$rules = [
				'business_name' => 'required',
				'password'  	=> 'required',
			];

			$msj = [
				'business_name'     => 'Campo requerido',
				'password'          => 'Campo requerido',
			];

			$validator = Validator::make($request->all(), $rules, $msj);

			if ($validator->fails()) {
				return response()->json([
					'success' => 'false',
					'errors'  => $validator->errors()->all()
				], 400);
			}

			try {

				User::where('email', $request->email)
				->update([
					'password' 			=> Hash::make($request->password),
					'verification_code' => Str::random(30)
				]);

			/**
			 * Registro de accion en el log
			 * del sistema
			 */
			$action = '16';
			ActivityLogController::store_log($action);

			/**
			 * Envio de notificacion por correo
			 */
			$type = 'verify_email_laboratory';
			$mailData = [
				'laboratory_name' => $user['business_name'],
				'laboratory_email' => $user['email'],
				'verify_code' => $user['verification_code'],
			];
			UtilsController::notification_mail($mailData, $type);

			return redirect('/')->with('success', 'El registro inicial fue satisfactorio');

			} catch (\Throwable $th) {
				$message = $th->getMessage();
				dd('Error Livewire.Components.Register.store()', $message);
			}
		}

	}

	public function update(Request $request)
	{

		try {

			if($request->rol == 'medico')
			{
				$rules = [
					'name' 		=> 'required',
					'last_name'	=> 'required',
					'ci' 		=> 'required',
					'birthdate' => 'required',
					'genere' 	=> 'required',
					'specialty' => 'required',
					'age' 		=> 'required',
					'phone' 	=> 'required',
					'state' 	=> 'required',
					'city' 		=> 'required',
					'address' 	=> 'required',
					'zip_code' 	=> 'required',
					'cod_mpps' 	=> 'required',
				];

				$msj = [
					'name' 		=> 'Campo requerido',
					'last_name'	=> 'Campo requerido',
					'ci' 		=> 'Campo requerido',
					'birthdate' => 'Campo requerido',
					'genere' 	=> 'Campo requerido',
					'specialty' => 'Campo requerido',
					'age' 		=> 'Campo requerido',
					'phone' 	=> 'Campo requerido',
					'state' 	=> 'Campo requerido',
					'city' 		=> 'Campo requerido',
					'address' 	=> 'Campo requerido',
					'zip_code' 	=> 'Campo requerido',
					'cod_mpps' 	=> 'Campo requerido',
				];

				$validator = Validator::make($request->all(), $rules, $msj);

				if ($validator->fails())
				{
					return response()->json([
						'success' => 'false',
						'errors'  => $validator->errors()->all()
					], 400);
				}

				// informacion del usuario
				$user = Auth::user();

				UtilsController::update_registro($user->id, $request);

				$action = '4';
				ActivityLogController::store_log($action);

				/**
				 * Acumulado para el manejo de estadisticas
				 * @param state
				 * @param 1 -> menor de edad
				 */
				EstadisticaController::accumulated_doctor($request->state);


				$caption = 'Bienvenido a sqlapio.com Dr(a). '.$request->name.' '.$request->last_name;
				$image = 'http://sqldevelop.sqlapio.net/img/notification_email/newsletter-header.png';
				$phone = preg_replace('/[\(\)\-\" "]+/', '', $request->phone);

				ApiServicesController::sms_welcome($phone, $caption, $image);

				return true;
			}

			if($request->rol == 'laboratorio' || $request->rol == 'corporativo')
			{
				$rules = [
					'rif' 		=> 'required',
					'state' 	=> 'required',
					'city' 		=> 'required',
					'address' 	=> 'required',
					'phone' 	=> 'required',
					'license' 	=> 'required',
					'type_laboratory' 	=> 'required',
					'responsible' 		=> 'required',
				];

				$msj = [
					'rif' 		=> 'Campo requerido',
					'state' 	=> 'Campo requerido',
					'city' 		=> 'Campo requerido',
					'address' 	=> 'Campo requerido',
					'phone' 	=> 'Campo requerido',
					'license' 	=> 'Campo requerido',
					'type_laboratory' 	=> 'Campo requerido',
					'responsible' 		=> 'Campo requerido',
				];

				$validator = Validator::make($request->all(), $rules, $msj);

				if ($validator->fails())
				{
					return response()->json([
						'success' => 'false',
						'errors'  => $validator->errors()->all()
					], 400);
				}

				/**
				 * Capturamos la imagen del laboratorio si
				 * fue cargada por el usuario
				 */

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

				// informacion del usuario
				$laboratory = Auth::user();

				$patient= Laboratory::updateOrCreate(['id' => $request->id],
                [

					'code_lab' 				=> 'SQ-LAB-'.random_int(11111111, 99999999),
					'user_id' 				=> $laboratory->id,
					'business_name' 		=> $request->business_name,
					'email' 				=> $request->email,
					'rif' 					=> $request->rif,
					'state' 				=> $request->state,
					'city' 					=> $request->city,
					'address' 				=> $request->address,
					'phone_1' 				=> $request->phone,
					'license' 				=> $request->license,
					'type_laboratory' 		=> $request->type_laboratory,
					'responsible' 			=> $request->responsible,
					'descripcion' 			=> $request->descripcion,
					'website' 				=> $request->website,
					'lab_img' 				=> $nameFile

				]);

				$update = DB::table('users')
					->where('id', $laboratory->id)
					->update([
						'status_register' => '2',
				]);

				$action = '17';
				ActivityLogController::store_log($action);

				return true;
			}

		} catch (\Throwable $th) {
			$message = $th->getMessage();
			dd('Error Livewire.Components.Register.store()', $message);
		}

	}

    public function register_doctor_corporate($hash)
    {
        $corporate = User::where('center_id', Crypt::decryptString($hash))->first();        
        $bellied_plan = null;
        $show = true;
        return view('livewire.components.register', compact('show', 'bellied_plan', 'corporate'));
    }

	public function render($id=null) {

		$bellied_plan = null;

		if($id!=null){
			$bellied_plan = BilledPlan::where('id', decrypt($id))->first();
		}
		$show = true;
		return view('livewire.components.register', compact('show', 'bellied_plan'));
	}

}
