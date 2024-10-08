<?php

namespace App\Http\Controllers;

use App\Models\GeneralStatistic;
use App\Models\Mes;
use App\Models\Patient;
use App\Models\Specialty;
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
            $modulo = 'UtilsController.user_asociate()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
        }

    }

	static function get_patient_corporate()
	{
		try {

			$lista_patient = Patient::where('center_id', Auth::user()->center_id)->with(['get_medicard_record'])->get();
			return $lista_patient;

		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_patient_corporate()';
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

    static function get_patient_attended_corporate ()
	{
		try {

			$labels = Mes::where('numero', '<=', now()->format('m'))->pluck('mes')->toArray();

            $valores = [];

            for($i=0; $i < count($labels); $i++){
                $valor = GeneralStatistic::where('mes', $labels[$i])->where('center', Auth::user()->center_id)->sum('dairy_finalizada');

                if(isset($valor)){
                    array_push($valores, $valor);
                }
            }

            return $valores;

		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_patient_attended_corporate';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}

    static function specialty()
    {
        try {

            $specialty = Specialty::all()->select('description')->pluck('description');
            return $specialty;

        } catch (\Throwable $th) {
            $error_log = $th->getMessage();
            $modulo = 'UtilsController.meses()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
        }
    }

    static function get_doctor_speciality ()
	{
		try {

			$labels = Specialty::all()->select('description')->pluck('description');

            $valores = [];

            for($i=0; $i < count($labels); $i++){
                $valor = User::where('specialty', $labels[$i])
                ->where('master_corporate_id', Auth::user()->id)
                ->count();

                if(isset($valor)){
                    array_push($valores, $valor);
                }
            }
            return $valores;

		} catch (\Throwable $th) {
			$error_log = $th->getMessage();
            $modulo = 'UtilsController.get_doctor_speciality()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
		}
	}
}
