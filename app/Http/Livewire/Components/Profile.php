<?php

namespace App\Http\Livewire\Components;

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\UtilsController;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Laboratory;
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
                    'business_name' => $request->ci,
                    'rif'           => $request->birthdate,
                    'state'         => $request->age,
                    'city'          => $request->phone,
                    'address'       => $request->address,
                    'phone_1'       => $request->phone_1,
                    'type_laboratory' => $request->type_laboratory,
                    'responsible'   => $request->responsible,
                    'descripcion'   => $request->descripcion,
                    'website'       => $request->website,
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
        if($request->action == 'rp'){
            $name = $request->email;
            $email = $request->email;
            $type = 'rp';
            $code = random_int(111111, 999999);
            DB::table('users')
                        ->where('email', $request->email)
                        ->update(['cod_update_pass' => $code]);

            UtilsController::notification_register_mail($code, $email, $name, $type);
            
            return true;
        }
        if($request->action == 'up'){
            $user = Auth::user();
            $name = $user->name.' '.$user->last_name;
            $type = 'up';
            $code = random_int(111111, 999999);
            DB::table('users')
                        ->where('email', $user->email)
                        ->update(['cod_update_email' => $code]);

            UtilsController::notification_register_mail($code, $request->email, $name, $type);
            
            return true;
        }
       
    }

    public function verify_otp(Request $request)
    {

        if($request->action == 'up')
        {

            $user = Auth::user();
       
            if($user->cod_update_email != $request->cod_update_email){
                return response()->json([
                    'success' => 'false',
                    'msj'  => 'El codigo de autorizacion es incorrecto.'
                ], 400);

            }else{

                    DB::table('users')
                        ->where('email', $user->email)
                        ->update(['email' => $request->email]);

                    return response()->json([
                        'success' => 'true',
                        'msj'  => 'Su direccion de correo fue actualizada de forma exitosa.'
                    ], 200);
            }
        }

        if($request->action == 'rp')
        {
            $user = User::where('email', $request->email)->first();

            if($request->cod_update_pass == $user->cod_update_pass)
            {
                DB::table('users')
                        ->where('email', $request->email)
                        ->update(['password' => Hash::make($request->password)]);

                    return response()->json([
                        'success' => 'true',
                        'msj'  => 'Su direccion de correo fue actualizada de forma exitosa.'
                    ], 200);
            }else{
                return response()->json([
                    'error' => 'true',
                    'msj'  => 'Su codigo de verificacion es incorrecto.'
                ], 400);
            }

        }

       
        
       
    }
   
    public function render()
    {
        $user = Auth::user();
        $laboratory = $user->get_laboratorio;  
        return view('livewire.components.profile', compact('user','laboratory'));
    }
}
