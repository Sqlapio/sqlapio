<?php

namespace App\Http\Controllers;

use App\Models\GeneralStatistic;
use App\Models\History;
use App\Models\MedicalRecord;
use App\Models\Mes;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EstadisticaController extends Controller
{

    /**
     * Acumulado para pacientes registrados
     */
    static function accumulated_patient($user_id, $center_id, $state, $genere, $is_minor = null)
    {
        try {

            $accumulated = new GeneralStatistic();
            $accumulated->user_id = $user_id;
            $accumulated->center = $center_id;
            $accumulated->patient = 1;
            $accumulated->is_minor = $is_minor;
            $accumulated->patient_genere = $genere;
            $accumulated->date = date('d-m-Y');
            $accumulated->state = $state;
            $accumulated->save();

        } catch (\Throwable $th) {
            $message = $th->getMessage();
			dd('Error EstadisticaController.accumulated_patient()', $message);
        }

    }

    /**
     * Acumulado para citas registrados
     */
    static function accumulated_dairy_sin_confirmar($user_id, $center_id)
    {
        try {

            $user_connect = Auth::user();
            $numero_mes = now()->format('m');
            $mes = Mes::where('numero', $numero_mes)->first()->mes;

            if($user_connect->type_plane == 7){
                $accumulated = new GeneralStatistic();
                $accumulated->user_id = $user_id;
                $accumulated->type_plane = $user_connect->type_plane;
                $accumulated->center = $user_connect->center_id;
                $accumulated->dairy_sin_confirmar = 1;
                $accumulated->mes = $mes;
                $accumulated->numero_mes = $numero_mes;
                $accumulated->date = date('d-m-Y');
                $accumulated->save();
            }else{
                $accumulated = new GeneralStatistic();
                $accumulated->user_id = $user_id;
                $accumulated->type_plane = $user_connect->type_plane;
                $accumulated->center = $center_id;
                $accumulated->dairy_sin_confirmar = 1;
                $accumulated->mes = $mes;
                $accumulated->numero_mes = $numero_mes;
                $accumulated->date = date('d-m-Y');
                $accumulated->save();
            }



        } catch (\Throwable $th) {
            $error_log = $th->getMessage();
            $modulo = 'UtilsController.get_appointments_not_attended()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
        }

    }

    /**
     * Acumulado para citas confirmadas por los pacientes
     */
    static function accumulated_dairy_confirmada($user_id, $center_id)
    {
        try {

            $user_connect = Auth::user();
            $numero_mes = now()->format('m');
            $mes = Mes::where('numero', $numero_mes)->first()->mes;

            if($user_connect->type_plane == 7){
                $accumulated = new GeneralStatistic();
                $accumulated->user_id = $user_id;
                $accumulated->type_plane = $user_connect->type_plane;
                $accumulated->center = $user_connect->center_id;
                $accumulated->dairy_confirmar = 1;
                $accumulated->mes = $mes;
                $accumulated->numero_mes = $numero_mes;
                $accumulated->date = date('d-m-Y');
                $accumulated->save();
            }else{
                $accumulated = new GeneralStatistic();
                $accumulated->user_id = $user_id;
                $accumulated->type_plane = $user_connect->type_plane;
                $accumulated->center = $center_id;
                $accumulated->dairy_confirmar = 1;
                $accumulated->mes = $mes;
                $accumulated->numero_mes = $numero_mes;
                $accumulated->date = date('d-m-Y');
                $accumulated->save();
            }


        } catch (\Throwable $th) {
            $error_log = $th->getMessage();
            $modulo = 'UtilsController.get_appointments_not_attended()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
        }

    }

    /**
     * Acumulado para citas finalizadas por los pacientes
     */
    static function accumulated_dairy_finalizada($user_id, $center_id)
    {
        try {

            $user_connect = Auth::user();
            $numero_mes = now()->format('m');
            $mes = Mes::where('numero', $numero_mes)->first()->mes;

            if($user_connect->type_plane == 7){
                $accumulated = new GeneralStatistic();
                $accumulated->user_id = $user_id;
                $accumulated->type_plane = $user_connect->type_plane;
                $accumulated->center = $user_connect->center_id;
                $accumulated->dairy_finalizada = 1;
                $accumulated->mes = $mes;
                $accumulated->numero_mes = $numero_mes;
                $accumulated->date = date('d-m-Y');
                $accumulated->save();
            }else{
                $accumulated = new GeneralStatistic();
                $accumulated->user_id = $user_id;
                $accumulated->type_plane = $user_connect->type_plane;
                $accumulated->center = $center_id;
                $accumulated->dairy_finalizada = 1;
                $accumulated->mes = $mes;
                $accumulated->numero_mes = $numero_mes;
                $accumulated->date = date('d-m-Y');
                $accumulated->save();
            }


        } catch (\Throwable $th) {
            $error_log = $th->getMessage();
            $modulo = 'UtilsController.get_appointments_not_attended()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
        }

    }

    /**
     * Acumulado para citas finalizadas por los pacientes
     */
    static function accumulated_dairy_cancelada($user_id, $center_id)
    {
        try {

            $user_connect = Auth::user();
            $numero_mes = now()->format('m');
            $mes = Mes::where('numero', $numero_mes)->first()->mes;

            if($user_connect->type_plane == 7){
                $accumulated = new GeneralStatistic();
                $accumulated->user_id = $user_id;
                $accumulated->type_plane = $user_connect->type_plane;
                $accumulated->center = $user_connect->center_id;
                $accumulated->dairy_cancelada = 1;
                $accumulated->mes = $mes;
                $accumulated->numero_mes = $numero_mes;
                $accumulated->date = date('d-m-Y');
                $accumulated->save();
            }else{
                $accumulated = new GeneralStatistic();
                $accumulated->user_id = $user_id;
                $accumulated->type_plane = $user_connect->type_plane;
                $accumulated->center = $center_id;
                $accumulated->dairy_cancelada = 1;
                $accumulated->mes = $mes;
                $accumulated->numero_mes = $numero_mes;
                $accumulated->date = date('d-m-Y');
                $accumulated->save();
            }


        } catch (\Throwable $th) {
            $error_log = $th->getMessage();
            $modulo = 'UtilsController.get_appointments_not_attended()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
        }

    }

    /**
     * Acumulado para citas finalizadas por los pacientes
     */
    static function accumulated_dairy_no_atendidas($user_id, $center_id)
    {
        try {

            $user_connect = Auth::user();
            $numero_mes = now()->format('m');
            $mes = Mes::where('numero', $numero_mes)->first()->mes;

            if($user_connect->type_plane == 7){
                $accumulated = new GeneralStatistic();
                $accumulated->user_id = $user_id;
                $accumulated->type_plane = $user_connect->type_plane;
                $accumulated->center = $user_connect->center_id;
                $accumulated->dairy_no_atendias = 1;
                $accumulated->mes = $mes;
                $accumulated->numero_mes = $numero_mes;
                $accumulated->date = date('d-m-Y');
                $accumulated->save();
            }else{
                $accumulated = new GeneralStatistic();
                $accumulated->user_id = $user_id;
                $accumulated->type_plane = $user_connect->type_plane;
                $accumulated->center = $center_id;
                $accumulated->dairy_no_atendias = 1;
                $accumulated->mes = $mes;
                $accumulated->numero_mes = $numero_mes;
                $accumulated->date = date('d-m-Y');
                $accumulated->save();
            }


        } catch (\Throwable $th) {
            $error_log = $th->getMessage();
            $modulo = 'UtilsController.get_appointments_not_attended()';
            ErrorController::error_log($modulo, $error_log);
            return view('error404');
        }

    }
    /**
     * Acumulado para pacientes registrados
     */
    static function accumulated_doctor($state)
    {
        try {

            $accumulated = new GeneralStatistic();
            $accumulated->user_id = 1;
            $accumulated->state = $state;
            $accumulated->date = date('d-m-Y');
            $accumulated->save();

        } catch (\Throwable $th) {
            $message = $th->getMessage();
			dd('Error EstadisticaController.accumulated_doctor()', $message);
        }

    }

    /**
     * Acumulado para pacientes registrados
     */
    static function accumulated_center($state)
    {
        try {

            $accumulated = new GeneralStatistic();
            $accumulated->center = 1;
            $accumulated->date = date('d-m-Y');
            $accumulated->save();

        } catch (\Throwable $th) {
            $message = $th->getMessage();
			dd('Error EstadisticaController.accumulated_center()', $message);
        }

    }

    /**
     * Total de Doctores registrados
     */
    static function total_doctors_register()
    {
        try {

            $total_doctors = User::count();
            return $total_doctors;

        } catch (\Throwable $th) {
            $message = $th->getMessage();
			dd('Error EstadisticaController.total_doctors_register()', $message);
        }

    }

    /**
     * Total de pacientes registrados
     */
    static function total_patient_register()
    {
        try {

            $total_patients = Patient::count();
            return $total_patients;

        } catch (\Throwable $th) {
            $message = $th->getMessage();
			dd('Error EstadisticaController.total_patient_register()', $message);
        }

    }

    /**
     * Total de historias registradas
     */
    static function total_history_register($id)
    {
        try {

            $total_histories = History::where('user_id',$id)->count();
            return $total_histories;

        } catch (\Throwable $th) {
            $message = $th->getMessage();
			dd('Error EstadisticaController.total_history_register()', $message);
        }

    }

    /**
     * Total de pacientes
     * asociados al medico
     * @param id
     */
    static function total_patient_doctors($id)
    {
        try {

            $total_patient_doctors = Patient::where('user_id', $id)->count();
            return $total_patient_doctors;

        } catch (\Throwable $th) {
            $message = $th->getMessage();
			dd('Error EstadisticaController.total_patient_doctors()', $message);
        }

    }

    /**
     * Total de consultas medicas
     * asociadas al medico
     * @param id
     */
    static function total_medical_record()
    {
        try {

            $numero_mes = now()->format('m');
            $mes = Mes::where('numero', $numero_mes)->first()->mes;

            $mov_medical_record = new GeneralStatistic();
            $mov_medical_record->user_id = Auth::user()->id;
            $mov_medical_record->medical_record = 1;
            $mov_medical_record->mes = $mes;
            $mov_medical_record->numero_mes = $numero_mes;
            $mov_medical_record->date = now()->format('d-m-Y');
            $mov_medical_record->save();

        } catch (\Throwable $th) {
            $message = $th->getMessage();
            dd('Error EstadisticaController.total_medical_record()', $message);
        }

    }

    /**
     * Total de menores de edad registrados
     */
    static function total_patient_minor()
    {
        try {

            $total_patient_minor = Patient::where('is_minor', 'true')->count();
            return $total_patient_minor;

        } catch (\Throwable $th) {
            $message = $th->getMessage();
			dd('Error EstadisticaController.total_patient_minor()', $message);
        }

    }

    static function total_patient_genero()
    {
        try {
            $total_patient_femenino = Patient::where('genere', 'femenino')->count();
            $total_patient_masculino = Patient::where('genere', 'masculino')->count();
            return [
               'femenino' => $total_patient_femenino ,
               'masculino' => $total_patient_masculino
            ];

        } catch (\Throwable $th) {
            $message = $th->getMessage();
			dd('Error EstadisticaController.total_patient_minor()', $message);
        }

    }



}
