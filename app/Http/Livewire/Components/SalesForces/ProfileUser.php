<?php

namespace App\Http\Livewire\Components\SalesForces;

use App\Http\Controllers\ActivityLogController;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;

class ProfileUser extends Component
{

    public function updateProfile(Request $request)
    {
        try {

            $rules = [
                'name'         => 'required',
                'last_name'    => 'required',
                'ci'         => 'required',
                'genere'     => 'required',
                'phone'     => 'required',
                'address'     => 'required',
            ];

            $msj = [
                'name'         => 'Campo requerido',
                'last_name'    => 'Campo requerido',
                'ci'         => 'Campo requerido',
                'genere'     => 'Campo requerido',
                'phone'     => 'Campo requerido',
                'address'     => 'Campo requerido',
            ];


            $validator = Validator::make($request->all(), $rules, $msj);

            if ($validator->fails()) {
                return response()->json([
                    'success' => 'false',
                    'errors'  => $validator->errors()->all()
                ], 400);
            }


            if (Str::contains($request->img, 'base64')) {
                $file =  $request->img;
                if ($file != null) {
                    $png = strstr($file, 'data:image/png;base64');
                    $jpg = strstr($file, 'data:image/jpg;base64');
                    $jpeg = strstr($file, 'data:image/jpeg;base64');
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
                    }
                    $nameFile = uniqid() . $extension;

                    file_put_contents(public_path('imgs/') . $nameFile, $file);
                }
            } else {
                $nameFile = $request->img;
            }
            User::where('id', Auth::user()->id)->update([
                'name'         => $request->name,
                'last_name'    => $request->last_name,
                'ci'         => $request->ci,
                'genere'     => $request->genere,
                'phone'     => $request->phone,
                'address'     => $request->address,
                'user_img' 	=> $nameFile,
                'status_register' => '2',
            ]);

            $action = '4';
				ActivityLogController::store_log($action);

            return true;

        } catch (\Throwable $th) {

            return response()->json([
                'success' => 'false',
                'errors'  => ["Error interno del servidor"]
            ], 500);        
        }

       
    }

    public function render()
    {
        
        return view('livewire.components.sales-forces.profile-user');
    }
}
