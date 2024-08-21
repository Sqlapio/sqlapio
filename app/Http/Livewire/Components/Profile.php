<?php

namespace App\Http\Livewire\Components;

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\UtilsController;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Laboratory;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Profile extends Component
{
    public function update_laboratory(Request $request)
    {
        try {

            $update = DB::table('laboratories')
                ->where('id', $request->id)
                ->update([
                    'business_name'   => $request->ci,
                    'rif'             => $request->birthdate,
                    'state'           => $request->age,
                    'city'            => $request->phone,
                    'address'         => $request->address,
                    'phone_1'         => $request->phonenumber_prefix . "-" . $request->phone_1,
                    'type_laboratory' => $request->type_laboratory,
                    'responsible'     => $request->responsible,
                    'descripcion'     => $request->descripcion,
                    'website'         => $request->website,
                ]);

            if ($update) {
                $action = '17';
                ActivityLogController::store_log($action);
                return true;
            }
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            dd('Error Livewire.Profile.update_laboratory()', $message);
        }
    }

    public function update_email(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        $update = DB::table('users')
            ->where('id', $user->id)
            ->update([
                'email' => $request->email,
            ]);
    }

    public function send_otp(Request $request)
    {
        if ($request->action == 'rp') {
            $user = User::where('email', $request->email)->first();

            if ($user == null) {
                return response()->json([
                    'error' => 'true',
                    'msj'  => __('messages.alert.correo_no_existe')
                ], 400);
            } else {
                $code = random_int(111111, 999999);
                DB::table('users')
                    ->where('email', $request->email)
                    ->update(['cod_update_pass' => $code]);

                $type = 'reset_pass';
                $mailData = [
                    'dr_email'      => $request->email,
                    'dr_name'       => $user->name . ' ' . $user->last_name,
                    'code'          => $code
                ];
                UtilsController::notification_mail($mailData, $type);

                return true;
            }
        }
        if ($request->action == 'up') {
            $user = Auth::user();

            $name = $user->name . ' ' . $user->last_name;
            $code = random_int(111111, 999999);
            DB::table('users')
                ->where('email', $user->email)
                ->update(['cod_update_email' => $code]);

            $type = 'update_email';
            $mailData = [
                'dr_email'      => $request->email,
                'dr_name'       => $user->name . ' ' . $user->last_name,
                'code'          => $code
            ];
            UtilsController::notification_mail($mailData, $type);

            UtilsController::notification_register_mail($code, $request->email, $name, $type);

            return true;
        }
    }

    public function verify_otp(Request $request)
    {
        if ($request->action == 'up') {

            $user = Auth::user();

            if ($user->cod_update_email != $request->cod_update_email) {
                return response()->json([
                    'success' => 'false',
                    'msj'  => __('messages.alert.codigo_incorrecto')
                ], 400);
            } else {

                DB::table('users')
                    ->where('email', $user->email)
                    ->update(['email' => $request->email]);

                return response()->json([
                    'success' => 'true',
                    'msj'  => __('messages.alert.correo_actualizado')
                ], 200);

                /**
                 * Registro de accion en el log
                 * del sistema
                 */
                $action = '20';
                ActivityLogController::store_log($action);
            }
        }

        if ($request->action == 'rp') {

            $user = User::where('email', $request->email)->first();

            if ($request->cod_update_pass == $user->cod_update_pass) {
                DB::table('users')
                    ->where('email', $request->email)
                    ->update(['password' => Hash::make($request->password)]);

                return response()->json([
                    'success' => 'true',
                    'msj'  => __('messages.alert.clave_actualizada')
                ], 200);
            } else {
                return response()->json([
                    'error' => 'true',
                    'msj'  => __('messages.alert.codigov_incorrecto')
                ], 400);
            }
        }
    }
    public function create_seal(Request $request)
    {

        $nameFile = null;

        $file =  $request->seal_img;
        if ($file != null) {
            $png     = strstr($file, 'data:image/png;base64');
            $jpg     = strstr($file, 'data:image/jpg;base64');
            $jpeg     = strstr($file, 'data:image/jpeg;base64');
            $pdf     = strstr($file, 'data:application/pdf;base64');
            if ($png != null) {
                $file = str_replace("data:image/png;base64,", "", $file);
                $file = base64_decode($file);
                $extension = ".png";
            } elseif ($jpeg != null) {
                $file = str_replace("data:image/jpeg;base64,", "", $file);
                $file = base64_decode($file);
                $extension = ".jpeg";
            } elseif ($jpg != null) {
                $file = str_replace("data:image/jpg;base64,", "", $file);
                $file = base64_decode($file);
                $extension = ".jpg";
            } elseif ($pdf != null) {
                $file = str_replace("data:application/pdf;base64,", "", $file);
                $file = base64_decode($file);
                $extension = ".pdf";
            }
            $nameFile = uniqid() . $extension;

            file_put_contents(public_path('imgs/seal/') . $nameFile, $file);
        }

        DB::table('users')
        ->where('id', Auth::user()->id)
        ->update([
            'digital_cello'  => $nameFile,
            'background_pdf' => $request->background_pdf,
        ]);

        return true;
    }

    public function render()
    {
        $user = Auth::user();
        $laboratory = $user->get_laboratorio;
        $speciality = Specialty::all();

        return view('livewire.components.profile', compact('user', 'laboratory', 'speciality'));
    }
}
