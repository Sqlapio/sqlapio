<?php

namespace App\Http\Controllers;

use App\Models\TemporaryEmailVerification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;



class HandleOtpController extends Controller
{

	static function send_otp(Request $request)
	{

		try {

			$user = User::where('email', $request->email)->first();

			if ($user == null) {

				$date_today = Carbon::createFromFormat('Y-m-d', date('Y-m-d'));

				$date_today = $date_today->addDay(30)->format('Y-m-d');

				$code = random_int(111111, 999999);

				$type = 'verify_email';

				$data = new TemporaryEmailVerification();
				$data->email = $request->email;
				$data->code =  $code;
				$data->document_number = $request->document_number;

				$data->save();

				$mailData = [
					'dr_email'      => $request->email,
					'dr_name'       => $request->name . " " . $request->last_name,
					'code'          => $code
				];

				UtilsController::notification_mail($mailData, $type);

				return response()->json([
					'success' => 'true',
					'msj'  => 'Operacion exitosa!'
				], 200);
			} else {

				return response()->json([
					'success' => false,
					'errors'  => "Email ya se encunetra registro"
				], 400);
			}
		} catch (\Throwable $th) {
			dd($th);

			return response()->json([
				'success' => 'false',
				'errors'  => "Error interno"
			], 500);
		}
	}

	static function verify_otp(Request $request)
	{

		$user = TemporaryEmailVerification::where('email', $request->email)
			->where('document_number', $request->ci)
			->where('code', $request->code)
			->where('status', false)
			->first();

		if ($user) {

			$user->status = true;
			$user->save();

			return true;
		} else {

			return false;
		}
	}
}
