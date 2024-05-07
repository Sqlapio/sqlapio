<?php

namespace App\Http\Livewire\Components;

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\UtilsController;
use App\Models\Center;
use App\Models\DoctorCenter;
use App\Models\State;
use App\Models\StateCountry;
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


            $user = Auth::user();

            $rules = [
                'center_id'              => 'required',
                'address'                => 'required',
                'number_floor'           => 'required',
                'number_consulting_room' => 'required',
            ];

            $msj = [
                'center_id.required'              => __('messages.alert.centro_obligatorio'),
                'address.required'                => __('messages.alert.direccion_obligatoria'),
                'number_floor.required'           => __('messages.alert.num_piso_obligatorio'),
                'number_consulting_room.required' => __('messages.alert.num_cons_obligatorio'),

            ];

            $validator = Validator::make($request->all(), $rules, $msj);

            if ($validator->fails()) {
                return response()->json([
                    'success' => 'false',
                    'errors'  => $validator->errors()->all()
                ], 400);
            }

            if ($request->center_id == "0") { //nuevo centro

                $state = State::where('id', $request->state_contrie)->first();

                $new_centers = new Center();
                $new_centers->address = $request->address;
                $new_centers->description = $request->full_name;
                $new_centers->state = $state->description;
                $new_centers->state_id = $request->state_contrie;
                $new_centers->country = Auth::user()->contrie;
                $new_centers->user_id = Auth::user()->id;
                $new_centers->city_contrie = $request->city_contrie;
                $new_centers->color = UtilsController::color_dairy();
                $new_centers->save();


                $doctor_centers = new DoctorCenter();
                $doctor_centers->address = $request->address;
                $doctor_centers->number_floor = $request->number_floor;
                $doctor_centers->number_consulting_room = $request->number_consulting_room;
                $doctor_centers->phone_consulting_room = $request->phone_consulting_room;
                $doctor_centers->user_id = Auth::user()->id;
                $doctor_centers->center_id = $new_centers->id;
                $doctor_centers->save();

                return true;
            } else {

                $center = DoctorCenter::where('user_id', $user->id)->where('center_id', $request->center_id)->first();

                if ($center != null) {
                    return response()->json([
                        'success' => 'false',
                        'errors'  => [__('messages.alert.centro_asociado')]
                    ], 400);
                }


                $doctor_centers = new DoctorCenter();
                $doctor_centers->address = $request->address;
                $doctor_centers->number_floor = $request->number_floor;
                $doctor_centers->number_consulting_room = $request->number_consulting_room;
                $doctor_centers->phone_consulting_room = $request->phone_consulting_room;
                $doctor_centers->user_id = $user->id;
                $doctor_centers->center_id = $request->center_id;
                $doctor_centers->save();

                $action = '10';

                ActivityLogController::store_log($action);

                /**
                 * Logica para el envio de la notificacion
                 * via correo electronico
                 */

                $email_verified_at = Auth::user()->email_verified_at;

                if ($email_verified_at != null) {
                    /**
                     * Notificacion al Doctor
                     */
                    $centers = Center::where('id', $request->center_id)->first();
                    $type = 'center';
                    $mailData = [
                        'dr_name'                => $user->name . ' ' . $user->last_name,
                        'dr_email'               => $user->email,
                        'center_name'            => $centers->description,
                        'center_address'         => $doctor_centers->address,
                        'center_floor'           => $doctor_centers->number_floor,
                        'center_consulting_room' => $doctor_centers->number_consulting_room,
                        'center_phone'           => $doctor_centers->phone_consulting_room,
                    ];

                    UtilsController::notification_mail($mailData, $type);
                }

                return true;
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => 'false',
                'errors'  => $th->getMessage()
            ], 500);
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

    public function regiter_center(Request $request)
    {
        try {

            $rules = [
                // 'contrie' => 'required',
                'address'       => 'required',
                'state_contrie' => 'required',
                'city_contrie'  => 'required',
                'full_name'     => 'required',
            ];

            $msj = [
                // 'contrie.required' => 'Campo requerido',
                'address.required'       => __('messages.alert.direccion_obligatoria'),
                'state_contrie.required' => __('messages.alert.estado_obligatorio'),
                'city_contrie.required'  => __('messages.alert.ciudad_obligatorio'),
                'full_name.required'     => __('messages.alert.nombre_obligatorio'),
            ];

            $validator = Validator::make($request->all(), $rules, $msj);

            if ($validator->fails()) {
                return response()->json([
                    'success' => 'false',
                    'errors'  => $validator->errors()->all()
                ], 400);
            }

            $state = State::where('id', $request->state_contrie)->first();

            $new_centers = new Center();
            $new_centers->address = $request->address;
            $new_centers->description = $request->full_name;
            $new_centers->state = $state->description;
            $new_centers->state_id = $request->state_contrie;
            $new_centers->country = Auth::user()->contrie;
            $new_centers->user_id = Auth::user()->id;
            $new_centers->city_contrie = $request->city_contrie;
            $new_centers->color = UtilsController::color_dairy();
            $new_centers->save();


            $doctor_centers = new DoctorCenter();
            $doctor_centers->address = $request->address;
            $doctor_centers->number_floor = $request->number_floor_new;
            $doctor_centers->number_consulting_room = $request->number_consulting_room_new;
            $doctor_centers->phone_consulting_room = $request->phone_consulting_room_new;
            $doctor_centers->user_id = Auth::user()->id;
            $doctor_centers->center_id = $new_centers->id;
            $doctor_centers->save();

            return true;
        } catch (\Throwable $th) {
            return response()->json([
                'success' => 'false',
                'errors'  => $th->getMessage()
            ], 500);
        }
    }

    public function render()
    {
        $user_id = Auth::user()->id;
        $user_state = Auth::user()->state;
        $doctor_centers = UtilsController::get_doctor_centers();
        $centers = UtilsController::get_centers($user_state);
        return view('livewire.components.centers', compact('doctor_centers', 'centers'));
    }
}
