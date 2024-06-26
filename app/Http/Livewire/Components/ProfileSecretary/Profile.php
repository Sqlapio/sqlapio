<?php

namespace App\Http\Livewire\Components\ProfileSecretary;

use Illuminate\Http\Request;
use Livewire\Component;
use App\Http\Controllers\ActivityLogController;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
class Profile extends Component
{

    public function update(Request $request)
    {

        try {

            $rules = [
                'name'      => 'required',
                'last_name' => 'required',
                'ci'        => 'required',
                'genere'    => 'required',
                'phone'     => 'required',
                'center_id' => 'required',

            ];

            $msj = [
                'name'      => __('messages.alert.nombre_obligatorio'),
                'last_name' => __('messages.alert.apellido_obligatorio'),
                'ci'        => __('messages.alert.cedula_obligatoria'),
                'genere'    => __('messages.alert.genero_obligatorio'),
                'phone'     => __('messages.alert.telefono_obligatorio'),
                'center_id' => __('messages.alert.centro_obligatorio'),
            ];
            $validator = Validator::make($request->all(), $rules, $msj);

            if ($validator->fails()) {
                return response()->json([
                    'success' => 'false',
                    'errors'  => $validator->errors()->all()
                ], 400);
            }

            User::where('id', auth()->user()->id)
                ->update([
                    'name'            => $request->name,
                    'last_name'       => $request->last_name,
                    'ci'              => $request->ci,
                    'genere'          => $request->genere,
                    'phone'           => $request->phonenumber_prefix . "-" . $request->phone,
                    'address'         => $request->address,
                    'status_register' => '2',
                    'center_id'       => $request->center_id,
                ]);

            $action = '4';

            ActivityLogController::store_log($action);

            return response()->json([
                'success' => true,
                'errors'  => $validator->errors()->all()
            ], 200);

        } catch (\Throwable $th) {

            return response()->json([
                'success' => false,
                'errors'  => "Error interno"
            ], 500);

        }
    }
    public function render()
    {

        $centerDoctor = auth()->user()->get_data_corporate_master->get_doctors;

        $centerId = auth()->user()->get_data_corporate_master;

        // dd($centerDoctor, $centerId);

        return view('livewire.components.profile-secretary.profile',compact('centerDoctor', 'centerId'));
    }
}
