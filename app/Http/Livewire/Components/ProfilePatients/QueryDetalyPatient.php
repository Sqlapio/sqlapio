<?php

namespace App\Http\Livewire\Components\ProfilePatients;

use App\Http\Controllers\UtilsController;
use App\Models\ExamPatient;
use App\Models\Patient;
use Illuminate\Http\Request;
use Livewire\Component;

class QueryDetalyPatient extends Component
{
	public function search_detaly(Request $request)
	{

		$data = [];
		$medicard_record = [];

		$tablePat =  Patient::where('ci', $request->ci)->where('birthdate', $request->birthdate);

		$tableRep =  Patient::where('birthdate', $request->birthdate)
			->whereHas('get_reprensetative', function ($q) use ($request) {
				$q->where('re_ci', $request->ci);
			});
		$patients = $tablePat->union($tableRep)->first();

		//preparar datos de la consulta medica
		if ($patients != null) {

			foreach ($patients->get_medicard_record as $key => $record) {

				$medicard_record[$key] = [
					"id" => encrypt($record->id),
					"record_code" => $record->record_code,
					"record_date" => $record->record_date,
					"doctor" => $record->get_doctor->name . " " . $record->get_doctor->last_name,
					"specialty" => $record->get_doctor->specialty,
					"study_medical" =>	$record->get_study_medical,
					"exam_medical" =>	$record->get_exam_medical,
					"razon" => $record->razon,
					"diagnosis" => $record->diagnosis,
				];
			}
			//end
			$data[] = [
				//datos del paciente
				"id" => encrypt($patients->id),
				"img" => $patients->patient_img,
				"full_name" => $patients->name . " " . $patients->last_name,
				"birthdate" => $patients->birthdate,
				"ci" => ($patients->is_minor == 'true') ? $patients->get_reprensetative->re_ci : $patients->ci,
				"age" => $patients->age,
				"genere" => $patients->genere,
				//datos de la historia clinica 
				'cod_history' => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->cod_history,
				'weight' => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->weight,
				'height' => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->height,
				'strain' => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->strain,
				"reason" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->reason,
				"current_illness" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->current_illness,
				"temperature" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->temperature,
				"breaths" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->breaths,
				"pulse" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->pulse,
				"saturation" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->saturation,
				"condition" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->condition,
				"applied_studies" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->applied_studies,
				"info_add" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->info_add,
				"hidratado" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->hidratado,
				"eupenico" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->eupenico,
				"febril" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->febril,
				"esfera_neurologica" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->esfera_neurologica,
				"glasgow" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->glasgow,
				"esfera_orl" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->esfera_orl,
				"esfera_cardiopulmonar" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->esfera_cardiopulmonar,
				"esfera_abdominal" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->esfera_abdominal,
				"extremidades" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->extremidades,
				"cancer" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->cancer,
				"diabetes" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->diabetes,
				"tension_alta" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->tension_alta,
				"cardiacos" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->cardiacos,
				"psiquiatricas" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->alteraciones_coagulacion,
				"alteraciones_coagulacion" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->alteraciones_coagulacion,
				"trombosis_embolas" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->trombosis_embolas,
				"tranfusiones_sanguineas" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->tranfusiones_sanguineas,
				"COVID19" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->COVID19,
				"no_aplica_back" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->no_aplica_back,
				"hepatitis" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->hepatitis,
				"VIH_SIDA" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->VIH_SIDA,
				"gastritis_ulceras" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->gastritis_ulceras,
				"neurologia" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->neurologia,
				"ansiedad_angustia" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->ansiedad_angustia,
				"tiroides" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->tiroides,
				"lupus" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->lupus,
				"enfermedad_autoimmune" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->enfermedad_autoimmune,
				"diabetes_mellitus" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->diabetes_mellitus,
				"presion_arterial_alta" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->presion_arterial_alta,
				"tiene_cateter_venoso" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->tiene_cateter_venoso,
				"fracturas" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->fracturas,
				"trombosis_venosa" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->trombosis_venosa,
				"embolia_pulmonar" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->cod_history,
				"varices_piernas" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->embolia_pulmonar,
				"insuficiencia_arterial" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->varices_piernas,
				"coagulacion_anormal" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->insuficiencia_arterial,
				"moretones_frecuentes" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->coagulacion_anormal,
				"sangrado_cirugias_previas" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->coagulacion_anormal,
				"sangrado_cepillado_dental" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->sangrado_cepillado_dental,
				"no_aplic_pathology" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->no_aplic_pathology,
				"alcohol" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->alcohol,
				"drogas" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->drogas,
				"vacunas_recientes" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->vacunas_recientes,
				"transfusiones_sanguineas" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->transfusiones_sanguineas,
				"no_aplica_no_pathology" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->no_aplica_no_pathology,
				"edad_primera_menstruation" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->edad_primera_menstruation,
				"fecha_ultima_regla" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->fecha_ultima_regla,
				"numero_embarazos" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->numero_embarazos,
				"numero_partos" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->numero_partos,
				"numero_abortos" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->numero_abortos,
				"pregunta" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->pregunta,
				"cesareas" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->cesareas,
				"allergies" => ($patients->get_history == null) ? "Sin historia clinica" : json_decode($patients->get_history->allergies, true),
				"history_surgical" => ($patients->get_history == null) ? "Sin historia clinica" : json_decode($patients->get_history->history_surgical, true),
				"medications_supplements" => ($patients->get_history == null) ? "Sin historia clinica" : json_decode($patients->get_history->medications_supplements, true),
				"observations_ginecologica" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->observations_ginecologica,
				"observations_allergies" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->observations_allergies,
				"observations_medication" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->observations_medication,
				"observations_back_family" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->observations_back_family,
				"observations_diagnosis" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->observations_diagnosis,
				"observations_not_pathological" => ($patients->get_history == null) ? "Sin historia clinica" : $patients->get_history->observations_not_pathological,
				/// end
				'info_medical_record' =>  $medicard_record,
			];
		}

		return $data;
	}

	public function render()
	{

		$vital_sing = UtilsController::get_history_vital_sing();
		$family_back = UtilsController::get_history_family_back();
		$pathology_back = UtilsController::get_history_pathology_back();
		$non_pathology_back = UtilsController::get_history_non_pathology_back();
		$get_condition = UtilsController::get_condition();

		return view(
			'livewire.components.profile-patients.query-detaly-patient',
			compact(
				'vital_sing',
				'family_back',
				'pathology_back',
				'non_pathology_back',
				'get_condition'
			)
		);
	}
}
