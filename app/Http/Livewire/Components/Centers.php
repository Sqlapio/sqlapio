<?php

namespace App\Http\Livewire\Components;

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\UtilsController;
use App\Models\Center;
use App\Models\DoctorCenter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Centers extends Component
{

    public function store(Request $request)
    {
        try {

            $user = Auth::user()->id;

            $rules = [
                'center_id' => 'required',
                'address' => 'required',
                'number_floor' => 'required|numeric',
                'number_consulting_room' => 'required|numeric',
            ];

            $msj = [
                'center_id.required' => 'Campo requerido',
                'name.required' => 'Campo requerido',
                'number_floor.required' => 'Campo requerido',
                'number_consulting_room.required' => 'Campo requerido',
                'number_floor.numeric' => 'El valor debe ser numerico',
                'number_consulting_room.numeric' => 'El valor debe ser numerico',
            ];

            $validator = Validator::make($request->all(), $rules, $msj);

            if ($validator->fails()) {
                return response()->json([
                    'success' => 'false',
                    'errors'  => $validator->errors()->all()
                ], 400);
            }

            $doctor_centers = new DoctorCenter();
            $doctor_centers->address = $request->address;
            $doctor_centers->number_floor = $request->number_floor;
            $doctor_centers->number_consulting_room = $request->number_consulting_room;
            $doctor_centers->phone_consulting_room = $request->phone_consulting_room;
            $doctor_centers->user_id = $user;
            $doctor_centers->center_id = $request->center_id;
            $doctor_centers->save();

            $action = '10';

            ActivityLogController::store_log($action);

            /**
             * Logica para el envio de la notificacion 
             * via correo electronico
             * 
             * @uses
             * Esta logica solo sera aplicada si el usuario
             * realizo la confirmacion del correo electronico
             */

             $email_verified_at = Auth::user()->email_verified_at;

            
            if($email_verified_at != null)
            {
                $centers = Center::where('id', $request->center_id)->get();
                
                foreach ($centers as $item) 
                {
                    $name_center = $item-> description;
                }

                $doctor_email = Auth::user()->email;
                
                $title = 'Mail de SqlapioTechnology';
                $body = [
                    'cuerpo' => 'Usted acaba de asociar el centro: ',
                    'name' => $name_center,
                ];


                // UtilsController::notification_email($doctor_email, $title, $body);

            }
            
            return true;

        } catch (\Throwable $th) {
            $message = $th->getMessage();
            dd('Error Livewire.Components.Centers.store()', $message);
        }
    }

    public function centers_disabled($id)
    {
        try {

            $centers_disabled = DB::table('doctor_centers')
              ->where('id', $id)
              ->update(['status' => 2]);

        } catch (\Throwable $th) {
            $message = $th->getMessage();
            dd('Error Livewire.Components.centers.centers_disabled()', $message);
        }
    }

    public function centers_enabled($id)
    {
        try {

            $centers_enabled = DB::table('doctor_centers')
              ->where('id', $id)
              ->update(['status' => 1]);

        } catch (\Throwable $th) {
            $message = $th->getMessage();
            dd('Error Livewire.Components.centers.centers_enabled()', $message);
        }
    }

    public function render()
    {
        $user_id = Auth::user()->id;
        $user_state = Auth::user()->state;
        $doctor_centers = UtilsController::get_doctor_centers();
        $centers = UtilsController::get_centers($user_state);              
        return view('livewire.components.centers', compact('doctor_centers','centers'));
    }
}
