<?php

namespace App\Http\Livewire\Components\ProfilePatients;

use App\Http\Controllers\UtilsController;
use App\Models\UserPatients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class RecoveryPassword extends Component
{

    public function handleRecoveryPass(Request $request)
    {

        try {
            $user = UserPatients::where("username", $request->document_number)->first();

            if ($user) {

                $email = ($user->patients->is_minor == "true") ?  $user->patients->get_reprensetative->re_email : $user->patients->email;
                $mailData = [
                    'email' => $email,
                    'password' =>  $user->pass_tem,
                ];

                UtilsController::notification_mail($mailData, "recovery_pass_pat");

                return response()->json([
                    'success' => true,
                    'msj'  => "operacion exitosa"
                ], 200);
            } else {

                return response()->json([
                    'success' => false,
                    'msj'  => "no autorizado"
                ], 401);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'msj'  => "Error interno"
            ], 500);
        }
    }

    public function render()
    {
        return view('livewire.components.profile-patients.recovery-password');
    }
}
