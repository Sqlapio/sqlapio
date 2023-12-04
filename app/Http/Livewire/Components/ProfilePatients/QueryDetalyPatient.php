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
		$medicard_record = [];		

		$tablePat =  Patient::where('ci', $request->ci)->where('birthdate', $request->birthdate);

		$tableRep =  Patient::where('birthdate', $request->birthdate)
			->whereHas('get_reprensetative', function ($q) use ($request) {
				$q->where('re_ci', $request->ci);
			});
		$patients = $tablePat->union($tableRep)->first();
	
		//preparar datos de la consulta medica
		if ($patients != null) {

			foreach($patients->get_medicard_record as $key => $record ){

				$medicard_record[$key] = [
					"id" =>encrypt($record->id),
					"record_code" =>$record->record_code,
					"record_date" =>$record->record_date,
					"doctor" =>$record->get_doctor->name." ".$record->get_doctor->last_name,	
					"specialty" =>$record->get_doctor->specialty,	
					"study_medical" =>	$record->get_study_medical,		
					"exam_medical" =>	$record->get_exam_medical,
				];
			}
			//end

			$data[] = [
				//datos del paciente
				"id" =>encrypt($patients->id),
				"img" =>$patients->patient_img,
				"full_name" =>$patients->name." ".$patients->last_name,
				"birthdate" =>$patients->birthdate,	
				"ci" =>($patients->is_minor=='true')?$patients->get_reprensetative->re_ci :$patients->ci,
				"age" =>$patients->age,			
				"genere" => $patients->genere,
				//datos de la historia clinica 
				'cod_history' =>  $patients->get_history->cod_history,
				'weight' =>  $patients->get_history->weight,
				'height' =>  $patients->get_history->height,
				'strain' =>  $patients->get_history->strain,
				///
				'info_medical_record' =>  $medicard_record,				
			];
		}

		return $data;
	}

	public function render()
	{
		
		return view('livewire.components.profile-patients.query-detaly-patient');
	}
}
