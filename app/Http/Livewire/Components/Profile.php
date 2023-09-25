<?php

namespace App\Http\Livewire\Components;

use App\Http\Controllers\ActivityLogController;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Laboratory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
   
    public function render()
    {
        $user = Auth::user();
        $laboratory = $user->get_laboratorio;  
        return view('livewire.components.profile', compact('user','laboratory'));
    }
}
