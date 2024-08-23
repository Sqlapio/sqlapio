<?php

namespace App\Http\Livewire\Components;

use App\Http\Controllers\UtilsController;
use App\Models\ExamPatient;
use App\Models\Patient;
use App\Models\Reference;
use App\Models\StudyPatient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Examen extends Component
{
    public function res_exam(Request $request, $active = false)
    {
        try {
                // Page Length
            if (!$active) {
                $pageNumber =  ($request->start / $request->length) + 1;
                $pageLength = $request->length;
                $skip       = ($pageNumber - 1) * $pageLength;
            } else {
                $skip = 0;
                $pageLength = 10;
            }

            $count = ExamPatient::where('status', 2)
                ->where('user_id', Auth::user()->id)->get();

            $data = ExamPatient::where('status', 2)
                ->where('user_id', Auth::user()->id)
                ->skip($skip)         // punto de partida
                ->take($pageLength)   // limite de resgistro
                ->with(['get_laboratory', 'get_patients', 'get_reprensetative'])->get();

            $res = [
                "data" => $data,
                "count" => count($count),
                "skip" => $skip,
                "limit" => $pageLength,
            ];

            return $res;
            //code...
        } catch (\Throwable $th) {
            return response()->json([
                'success' => 'false',
                'errors'  => $th->getMessage()
            ], 500);
        }
    }

    public function res_exam_patient($id)
    {
        try {

            $count = ExamPatient::where('status', 2)
            ->where('patient_id', $id)->get();

            $data = ExamPatient::where('status', 2)
                ->where('patient_id', $id)
                ->skip(0)         // punto de partida
                ->take(10)   // limite de resgistro
                ->with(['get_laboratory', 'get_patients', 'get_reprensetative'])->get();

            $res = [
                "data" => $data,
                "count" => count($count),
                "skip" => 0,
                "limit" => 10,
            ];

            return $res;
            //code...
        } catch (\Throwable $th) {
            return response()->json([
                'success' => 'false',
                'errors'  => $th->getMessage()
            ], 500);
        }
    }

    public function res_exam_sin_resul(Request $request, $active = false)
    {
        try {

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
                ->with(['get_examne_stutus_uno'])->get();

            $data =  Reference::where('user_id',  Auth::user()->id)
                ->skip($skip)         // punto de partida
                ->take($pageLength)   // limite de resgistro
                ->with(['get_patient', 'get_examne_stutus_uno', 'get_reprensetative'])
                ->get();

            $res = [
                "data" => $data,
                "count" => count($count),
                "skip" => $skip,
                "limit" => $pageLength,
            ];

            return $res;
            //code...
        } catch (\Throwable $th) {
            return response()->json([
                'success' => 'false',
                'errors'  => $th->getMessage()
            ], 500);
        }
    }

    public function res_exam_sin_resul_patient($id)
    {
        try {

            $count =  Reference::where('patient_id',  $id)
            ->with(['get_examne_stutus_uno'])->get();

            $data =  Reference::where('patient_id',  $id)
                ->skip(0)         // punto de partida
                ->take(10)   // limite de resgistro
                ->with(['get_patient', 'get_examne_stutus_uno', 'get_reprensetative'])
                ->get();

            $res = [
                "data" => $data,
                "count" => count($count),
                "skip" => 0,
                "limit" => 10,
            ];

            return $res;
            //code...
        } catch (\Throwable $th) {
            return response()->json([
                'success' => 'false',
                'errors'  => $th->getMessage()
            ], 500);
        }
    }


    public function render(Request $request, $id = null)
    {
        $exam = UtilsController::get_exam();

        $data = [];

        if ($id != null) {

            $data = $this->res_exam_patient($id);

            $examen_sin_resul = $this->res_exam_sin_resul_patient($id);
        } else {

            $data = $this->res_exam($request, true);

            $examen_sin_resul = $this->res_exam_sin_resul($request, true);
        }
        return view('livewire.components.examen', compact('data', 'examen_sin_resul', 'id', 'exam'));
    }
}
