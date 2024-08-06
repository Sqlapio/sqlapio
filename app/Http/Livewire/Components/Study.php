<?php

namespace App\Http\Livewire\Components;

use App\Models\Patient;
use App\Models\Reference;
use App\Models\StudyPatient;
use App\Http\Controllers\UtilsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Study extends Component
{

    public function res_study(Request $request, $active = false)
    {

        // Page Length
        if (!$active) {
            $pageNumber =  ($request->start / $request->length) + 1;
            $pageLength = $request->length;
            $skip       = ($pageNumber - 1) * $pageLength;
        } else {
            $skip = 0;
            $pageLength = 10;
        }

        $count = StudyPatient::where('status', 2)
            ->where('user_id', Auth::user()->id)->get();

        $data = StudyPatient::where('status', 2)
            ->where('user_id', Auth::user()->id)
            ->skip($skip)         // punto de partida
            ->take($pageLength)   // limite de resgistro
            ->with(['get_laboratory', 'get_patient', 'get_reprensetative'])->get();

        $res = [
            "data" => $data,
            "count" => count($count),
            "skip" => $skip,
            "limit" => $pageLength,
        ];

        return $res;
    }

    public function res_study_patient($id)
    {

        $count = StudyPatient::where('status', 2)
            ->where('patient_id', $id)->get();

        $data = StudyPatient::where('status', 2)
            ->where('patient_id', $id)
            ->skip(0)         // punto de partida
            ->take(10)   // limite de resgistro
            ->with(['get_laboratory', 'get_patient', 'get_reprensetative'])->get();

        $res = [
            "data" => $data,
            "count" => count($count),
            "skip" => 0,
            "limit" => 10,
        ];

        return $res;
    }

    public function res_study_sin_resul(Request $request, $active = false)
    {

        // Page Length
        if (!$active) {
            $pageNumber = ($request->start / $request->length) + 1;
            $pageLength = $request->length;
            $skip       = ($pageNumber - 1) * $pageLength;
        } else {
            $skip = 0;
            $pageLength = 10;
        }
        $count =  Reference::where('user_id',  Auth::user()->id)
            ->with(['get_estudio_stutus_uno'])->get();

        $data =  Reference::where('user_id',  Auth::user()->id)
            ->skip($skip)         // punto de partida
            ->take($pageLength)   // limite de resgistro
            ->with(['get_patient', 'get_estudio_stutus_uno', 'get_reprensetative'])
            ->get();

        $res = [
            "data" => $data,
            "count" => count($count),
            "skip" => $skip,
            "limit" => $pageLength,
        ];

        return $res;
    }

    public function res_study_sin_resul_patient($id)
    {

        $count =  Reference::where('patient_id',  $id)
            ->with(['get_estudio_stutus_uno'])->get();

        $data =  Reference::where('patient_id',  $id)
            ->skip(0)         // punto de partida
            ->take(10)   // limite de resgistro
            ->with(['get_patient', 'get_estudio_stutus_uno', 'get_reprensetative'])
            ->get();

        $res = [
            "data" => $data,
            "count" => count($count),
            "skip" => 0,
            "limit" => 10,
        ];

        return $res;
    }


    public function render(Request $request, $id = null)
    {
        $study = UtilsController::get_study();

        $data = [];

        if ($id != null) {

            $data = $this->res_study_patient($id);

            $estudios_sin_resul = $this->res_study_sin_resul_patient($id);
        } else {

            $data = $this->res_study($request, true);

            $estudios_sin_resul = $this->res_study_sin_resul($request, true);
        }

        return view('livewire.components.study', compact('data', 'estudios_sin_resul', 'id', 'study'));
    }
}
