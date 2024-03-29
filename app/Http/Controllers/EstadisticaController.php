<?php

namespace App\Http\Controllers;

use App\Models\GeneralStatistic;
use App\Models\History;
use App\Models\MedicalRecord;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EstadisticaController extends Controller
{

    /**
     * Acumulado para pacientes registrados
     */
    static function accumulated_patient($state, $genere, $is_minor = null)
    {
        try {

            $accumulated = new GeneralStatistic();
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
     * Acumulado para pacientes registrados
     */
    static function accumulated_doctor($state)
    {
        try {

            $accumulated = new GeneralStatistic();
            $accumulated->user = 1;
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
    static function total_history_register()
    {
        try {

            $total_histories = History::where('user_id', Auth::user()->id)->count();
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
    static function total_patient_doctors()
    {
        try {

            $total_patient_doctors = Patient::where('user_id', Auth::user()->id)->count();
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
    static function total_medical_record($id)
    {
        try {

            $total_medical_record = MedicalRecord::where('user_id', $id)->count();
            return $total_medical_record;

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
