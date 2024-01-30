<?php

namespace App\Http\Livewire\Components;

use App\Models\ExamPatient;
use App\Models\Patient;
use App\Models\Reference;
use App\Models\StudyPatient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Examen extends Component
{
    public function res_exam(Request $request)
    {

        // Page Length
        $pageNumber = ($request->start / $request->length) + 1;
        $pageLength = $request->length;
        $skip       = ($pageNumber - 1) * $pageLength;
        dd($pageNumber,$pageLength,$skip );

        // Page Order
        // $orderColumnIndex = $request->order[0]['column'] ?? '0';
        // $orderBy = $request->order[0]['dir'] ?? 'desc';

        // // get data from products table
        // $query = DB::table('products')->select('*');

        // // Search
        // $search = $request->search;
        // $query = $query->where(function ($query) use ($search) {
        //     $query->orWhere('name', 'like', "%" . $search . "%");
        //     $query->orWhere('description', 'like', "%" . $search . "%");
        //     $query->orWhere('amount', 'like', "%" . $search . "%");
        // });

        // $orderByName = 'name';
        // switch ($orderColumnIndex) {
        //     case '0':
        //         $orderByName = 'name';
        //         break;
        //     case '1':
        //         $orderByName = 'description';
        //         break;
        //     case '2':
        //         $orderByName = 'amount';
        //         break;
        // }
        // $query = $query->orderBy($orderByName, $orderBy);
        // $recordsFiltered = $recordsTotal = $query->count();
        // $users = $query->skip($skip)->take($pageLength)->get();

        return true;
    }


    public function render($id = null)
    {

        $data = [];
        if ($id != null) {
            $data = ExamPatient::where('status', 2)
                ->where('patient_id', $id)
                ->with('get_laboratory')->get();

            $examen_sin_resul =  Reference::where('patient_id',  $id)
                ->with(['get_patient', 'get_examne_stutus_uno', 'get_reprensetative'])->get();
        } else {

            $data = ExamPatient::where('status', 2)
                ->where('user_id', Auth::user()->id)
                ->with('get_laboratory')->get();

            $examen_sin_resul =  Reference::where('user_id',  Auth::user()->id)
                ->with(['get_patient', 'get_examne_stutus_uno', 'get_reprensetative'])->get();
        }

        return view('livewire.components.examen', compact('data', 'examen_sin_resul', 'id'));
    }
}
