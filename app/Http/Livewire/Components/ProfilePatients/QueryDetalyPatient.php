<?php

namespace App\Http\Livewire\Components\ProfilePatients;

use App\Models\ExamPatient;
use App\Models\Patient;
use Illuminate\Http\Request;
use Livewire\Component;

class QueryDetalyPatient extends Component
{
	public function search_detaly(Request $request)
	{

		$data = [];
		$tablePat =  Patient::where('ci', $request->ci)->where('birthdate', $request->birthdate);

		$tableRep =  Patient::where('birthdate', $request->birthdate)
			->whereHas('get_reprensetative', function ($q) use ($request) {
				$q->where('re_ci', $request->ci);
			});
		$patients = $tablePat->union($tableRep)->first();
		if ($patients != null) {
			$data[] = [
				'info_patient' =>  $patients,
				'info_history' =>  $patients->get_history,
				'info_medical_record' =>  $patients->get_medicard_record,
				'data_exam' =>  $patients->get_exams,
				'data_study' =>  $patients->get_studies,
			];
		}

		return $data;
	}

	public function render()
	{
		
		return view('livewire.components.profile-patients.query-detaly-patient');
	}
}
