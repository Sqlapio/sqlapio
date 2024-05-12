<?php

namespace App\Http\Livewire\Components\ProfilePatients;

use App\Http\Controllers\UtilsController;
use App\Models\ExamPatient;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class QueryDetalyPatient extends Component
{
	public function search_detaly($patient_id)
	{

		$data = [];

		$medicard_record = [];


		$tablePat =  Patient::where('id', $patient_id);

		$tableRep =  Patient::whereHas('get_reprensetative', function ($q) use ($patient_id) {
			$q->where('patient_id', $patient_id);
		});
		$patient = $tablePat->union($tableRep)->first();

		if ($patient) {

			foreach ($patient->get_medicard_record as $key => $record) {

				$medicard_record[$key] = [
					"id" => encrypt($record->id),
					"record_code" => $record->record_code,
					"record_date" => $record->record_date,
					"doctor" => $record->get_doctor->name . " " . $record->get_doctor->last_name,
					"specialty" => $record->get_doctor->specialty,
					"study_medical" =>	$record->get_study_medical_status_two,
					"exam_medical" =>	$record->get_exam_medical_status_two,
					"razon" => $record->razon,
					"diagnosis" => $record->diagnosis,
				];
			}

			$data = [
				//datos del paciente
				'patient' => $patient,
				'get_physical_exams' => $patient->get_physical_exams,
				"allergies" => ($patient->get_history) ? json_decode($patient->get_history->allergies, true) : null,
				"history_surgical" => ($patient->get_history) ? json_decode($patient->get_history->history_surgical, true) : null,
				"medications_supplements" => ($patient->get_history) ? json_decode($patient->get_history->medications_supplements, true) : null,
				'medicard_record' =>  $medicard_record,
			];
			return $data;
		} else {

			return false;
		}
	}

	public function render()
	{
		return view(
			'livewire.components.profile-patients.login-patient'
		);
	}

	public function toviewPatient()
	{
		$data =  $this->search_detaly(auth()->guard("users_patients")->user()->patient_id);

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
				'get_condition',
				"data"
			)
		);
	}
}
