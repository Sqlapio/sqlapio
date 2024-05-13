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

        $user = UserPatients::where("username", $request->document_number)->first();

        if ($user) {

            $email = ($user->patients->is_minor == "true") ?  $user->patients->get_reprensetative->re_email : $user->patients->email;
            $mailData = [
                'email' => $email,
                'password' =>  $user->password,
            ];

            UtilsController::notification_mail($mailData, "recovery_pass_pat");


            return true;
        } else {

            dd("no");
        }
    }


    public function render()
    {
        return view('livewire.components.profile-patients.recovery-password');
    }
}
