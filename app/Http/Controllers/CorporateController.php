<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CorporateController extends Controller
{
    static function user_asociate()
    {
        try {

            $users = User::where('center_id', Auth::user()->center_id)->where('master_corporate_id', Auth::user()->id)->get();
            return $users;

        } catch (\Throwable $th) {
            $error_log = $th->getMessage();
            $modulo = 'UtilsController.get_history()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
        }

    }

	static function get_patient_corporate()  
	{
		try {

			$lista_patient = Patient::where('center_id', Auth::user()->id)->get();
			return $lista_patient;

		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_patient_corporate()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}
}
