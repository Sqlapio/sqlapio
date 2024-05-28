<?php

namespace App\Http\Livewire\Components;

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\ApiServicesController;
use App\Http\Controllers\EstadisticaController;
use App\Http\Controllers\HandleOtpController;
use App\Http\Controllers\UtilsController;
use App\Models\BilledPlan;
use App\Models\Laboratory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Livewire\Component;
use Illuminate\Support\Carbon;
use Laravel\Cashier\Cashier;

class Register extends Component
{

    public function store(Request $request)
    {


        if (number_format($request->type_rif) >= 3) {
            $rules = [
                'business_name' => 'required',
                'password'      => 'required',
                'email'         => 'required|unique:users',
                'ci'            => 'required|unique:users',
            ];

            $msj = [
                'business_name'    => __('messages.alert.nombre_obligatorio'),
                'email.required'   => __('messages.alert.correo_obligatorio'),
                'email.unique'     => __('messages.alert.correo_existente'),
                'password'         => __('messages.alert.contraseña_obligatorio'),
                'ci.required'      => __('messages.alert.cedula_obligatoria'),
                'ci.unique'        => __('messages.alert.cedula_existente'),
            ];
        } else {
            $rules = [
                'name'      => 'required',
                'last_name' => 'required',
                'password'  => 'required',
                'email'     => 'required|unique:users',
                'ci'        => 'required|unique:users',
            ];

            $msj = [
                'name'              => __('messages.alert.nombre_obligatorio'),
                'last_name'         => __('messages.alert.apellido_obligatorio'),
                'email.required'    => __('messages.alert.correo_obligatorio'),
                'email.unique'      => __('messages.alert.correo_existente'),
                'password'          => __('messages.alert.contraseña_obligatorio'),
                'ci.required'       => __('messages.alert.cedula_obligatoria'),
                'ci.unique'         => __('messages.alert.cedula_existente'),
            ];
        }

        $validator = Validator::make($request->all(), $rules, $msj);

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'msj'  => $validator->errors()->all()
            ], 400);
        }

        $date_today = Carbon::createFromFormat('Y-m-d', date('Y-m-d'));

        $date_today = $date_today->addDay(30)->format('Y-m-d');

        // valdiar otp y capchat
        // if (HandleOtpController::verify_otp($request) && UtilsController::validateCapchat($request)) {
        if (HandleOtpController::verify_otp($request)) {

            $user = new User();
            $user->name = $request->name;
            $user->last_name = $request->last_name;
            $user->business_name = $request->business_name;
            $user->ci = $request->ci;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->verification_code = Str::random(30);
            $user->password = Hash::make($request->password);
            $user->email_verified_at = $date_today;
            if ($request->type_plan == '1') {
                $user->role = "medico";
            } elseif ($request->type_plan == '4') {
                $user->role = "laboratorio";
            } else {
                $user->role = "temporary";
            }
            $user->type_plane = $request->type_plan;
            $user->save();

            if (number_format($request->type_rif) != 7) {

                User::where("id", $user->id)->update([
                    "token_corporate" => env('APP_URL') . "/" . "registe-secretary/" . encrypt($user->id)
                ]);
            }


            /**Registro la accion del usuario registrado en el log */
            $action = '3';
            ActivityLogController::store_log($action);

            /**Registro del usuario en stripe de forma directa. Usando la clase de Stripe */
            $stripeCustomer = $user->createAsStripeCustomer();
            // /**Registro al accion de' Resgistro cliente STRIPE' en el log */
            $action = '25';
            ActivityLogController::store_log($action);

            return response()->json([
                'success' => true,
                'msj'  => __('messages.alert.registro_inicial')
            ], 200);
        } else {

            return response()->json([
                'success' => false,
                'msj'  => __('messages.alert.codigov_incorrecto')
            ], 400);
        }

        // if($user != null && $request->doctor_corporate == 'false')
        // {
        //     if($user->role == 'medico')
        //     {
        //         $rules = [
        //             'name'      => 'required',
        //             'last_name' => 'required',
        //             'password'  => 'required',
        //         ];

        //         $msj = [
        //             'name'              => 'Campo requerido',
        //             'last_name'         => 'Campo requerido',
        //             'password'          => 'Campo requerido',
        //             'password.min'      => 'Contraseña debe ser mayor a 6 caracteres',
        //             'password.max'      => 'Contraseña debe ser menor a 8 caracteres',
        //             'password.regex'    => 'Formato de contraseña  incorrecto',
        //         ];

        //         $validator = Validator::make($request->all(), $rules, $msj);

        //         if ($validator->fails()) {
        //             return Redirect::to('/')->withErrors($validator);
        //         }

        //         try {

        //             User::where('email', $request->email)
        //                 ->update([
        //                     'password'              => Hash::make($request->password),
        //                     'verification_code'     => Str::random(30),
        //                 ]);

        //         /**
        //          * Registro de accion en el log
        //          * del sistema
        //          */
        //         $action = '3';
        //         ActivityLogController::store_log($action);

        //         /**
        //          * Envio de notificacion por correo
        //          */
        //         $user_update = User::where('email', $request->email)->first();
        //         $type = 'verify_email';
        //         $mailData = [
        //             'dr_name' => $request->name.' '.$request->last_name,
        //             'dr_email' => $request->email,
        //             'verify_code' => $user_update->verification_code,
        //         ];

        //         UtilsController::notification_mail($mailData, $type);

        //         return redirect('/')->with('success', 'El registro inicial satisfactorio');

        //         } catch (\Throwable $th) {
        //             $message = $th->getMessage();
        //             dd('Error Livewire.Components.Register.store()', $message);
        //         }
        //     }

        //     if($user->role == 'laboratorio' || $user->role == 'corporativo')
        //     {

        //         $rules = [
        //             'business_name' => 'required',
        //             'password'  	=> 'required',
        //         ];

        //         $msj = [
        //             'business_name'     => 'Campo requerido',
        //             'password'          => 'Campo requerido',
        //         ];

        //         $validator = Validator::make($request->all(), $rules, $msj);

        //         if ($validator->fails()) {
        //             return response()->json([
        //                 'success' => 'false',
        //                 'errors'  => $validator->errors()->all()
        //             ], 400);
        //         }

        //         try {

        //             User::where('email', $request->email)
        //             ->update([
        //                 'password' 			=> Hash::make($request->password),
        //                 'verification_code' => Str::random(30)
        //             ]);

        //         /**
        //          * Registro de accion en el log
        //          * del sistema
        //          */
        //         $action = '16';
        //         ActivityLogController::store_log($action);

        //         /**
        //          * Envio de notificacion por correo
        //          */
        //         $user_update = User::where('email', $request->email)->first();
        //         if($user->role == 'laboratorio')
        //         {
        //             $type = 'verify_email_laboratory';

        //         }else{

        //             $type = 'verify_email_corporate';
        //         }
        //         $mailData = [
        //             'laboratory_name' => $user_update->business_name,
        //             'laboratory_email' => $user_update->email,
        //             'verify_code' => $user_update->verification_code,
        //         ];
        //         UtilsController::notification_mail($mailData, $type);

        //         return redirect('/')->with('success', 'El registro inicial fue satisfactorio');

        //         } catch (\Throwable $th) {
        //             $message = $th->getMessage();
        //             dd('Error Livewire.Components.Register.store()', $message);
        //         }
        //     }

        // }else{

        //     $rules = [
        //         'name'      => 'required',
        //         'last_name' => 'required',
        //         'email'     => 'required|unique:users',
        //         'password'  => 'required',
        //     ];

        //     $msj = [
        //         'name'              => 'Campo requerido',
        //         'last_name'         => 'Campo requerido',
        //         'password'          => 'Campo requerido',
        //         'password.min'      => 'Contraseña debe ser mayor a 6 caracteres',
        //         'password.max'      => 'Contraseña debe ser menor a 8 caracteres',
        //         'password.regex'    => 'Formato de contraseña  incorrecto',
        //         'unique'            => 'El correo electronico ya se encuentra registrado. Por favor intente con uno distinto.'
        //     ];

        //     $validator = Validator::make($request->all(), $rules, $msj);

        //     if ($validator->fails()) {
        //         return Redirect::back()->withErrors($validator);
        //     }

        //     try {

        //         $user_corporate = new User();
        //         $user_corporate->name = $request->name;
        //         $user_corporate->last_name = $request->last_name;
        //         $user_corporate->email = $request->email;
        //         $user_corporate->password = $request->password;
        //         $user_corporate->verification_code = Str::random(30);
        //         $user_corporate->role = 'medico';
        //         $user_corporate->type_plane = '7';
        //         $user_corporate->center_id = $request->center_id;
        //         $user_corporate->master_corporate_id = $request->user_corp_id;
        //         $user_corporate->save();

        //     /**
        //      * Registro de accion en el log
        //      * del sistema
        //      */
        //     $action = '3';
        //     ActivityLogController::store_log($action);

        //     /**
        //      * Envio de notificacion por correo
        //      */
        //     $user_update = User::where('email', $request->email)->first();
        //     $type = 'verify_email';
        //     $mailData = [
        //         'dr_name' => $request->name.' '.$request->last_name,
        //         'dr_email' => $request->email,
        //         'verify_code' => $user_update->verification_code,
        //     ];

        //     UtilsController::notification_mail($mailData, $type);

        //     return redirect('/')->with('success', 'El registro inicial satisfactorio');

        //     } catch (\Throwable $th) {
        //         $message = $th->getMessage();
        //         dd('Error Livewire.Components.Register.store()', $message);
        //     }
        // }



    }

    public function update(Request $request)
    {

        try {

            if ($request->rol == 'medico') {
                if (Auth::user()->type_plane == '7') {
                    /** Reglas de validacion para el medico corporativo */
                    $rules = [
                        'name'                    => 'required',
                        'last_name'               => 'required',
                        'ci'                      => 'required',
                        'birthdate'               => 'required',
                        'genere'                  => 'required',
                        'specialty'               => 'required',
                        'age'                     => 'required',
                        'phone'                   => 'required',
                        'state_contrie'           => 'required',
                        'city_contrie'            => 'required',
                        'contrie'                 => 'required',
                        'address'                 => 'required',
                        'zip_code'                => 'required',
                        'cod_mpps'                => 'required',
                        'number_floor'            => 'required',
                        'number_consulting_room'  => 'required',
                        'number_consulting_phone' => 'required',
                    ];

                    $msj = [
                        'name'                    => __('messages.alert.nombre_obligatorio'),
                        'last_name'               => __('messages.alert.apellido_obligatorio'),
                        'ci'                      => __('messages.alert.cedula_obligatoria'),
                        'birthdate'               => __('messages.alert.fecha_obligatorio'),
                        'genere'                  => __('messages.alert.genero_obligatorio'),
                        'specialty'               => __('messages.alert.especialidad_obligatorio'),
                        'age'                     => __('messages.alert.edad_obligatorio'),
                        'phone'                   => __('messages.alert.telefono_obligatorio'),
                        'state_contrie'           => __('messages.alert.estado_obligatorio'),
                        'city_contrie'            => __('messages.alert.ciudad_obligatorio'),
                        'contrie'                 => __('messages.alert.pais_obligatorio'),
                        'address'                 => __('messages.alert.direccion_obligatoria'),
                        'zip_code'                => __('messages.alert.codigo_obligatorio'),
                        'cod_mpps'                => __('messages.alert.mpps_obligatorio'),
                        'number_floor'            => __('messages.alert.num_piso_obligatorio'),
                        'number_consulting_room'  => __('messages.alert.num_cons_obligatorio'),
                        'number_consulting_phone' => __('messages.alert.num_tlf_obligatorio'),
                    ];
                } else {

                    /** Reglas de validacion para el medico libre */
                    $rules = [
                        'name'          => 'required',
                        'last_name'     => 'required',
                        'ci'            => 'required',
                        'birthdate'     => 'required',
                        'genere'        => 'required',
                        'specialty'     => 'required',
                        'age'           => 'required',
                        'phone'         => 'required',
                        'state_contrie' => 'required',
                        'city_contrie'  => 'required',
                        'contrie'       => 'required',
                        'address'       => 'required',
                        'zip_code'      => 'required',
                        'cod_mpps'      => 'required',
                    ];

                    $msj = [
                        'name'                    => __('messages.alert.nombre_obligatorio'),
                        'last_name'               => __('messages.alert.apellido_obligatorio'),
                        'ci'                      => __('messages.alert.cedula_obligatoria'),
                        'birthdate'               => __('messages.alert.fecha_obligatorio'),
                        'genere'                  => __('messages.alert.genero_obligatorio'),
                        'specialty'               => __('messages.alert.especialidad_obligatorio'),
                        'age'                     => __('messages.alert.edad_obligatorio'),
                        'phone'                   => __('messages.alert.telefono_obligatorio'),
                        'state_contrie'           => __('messages.alert.estado_obligatorio'),
                        'city_contrie'            => __('messages.alert.ciudad_obligatorio'),
                        'contrie'                 => __('messages.alert.pais_obligatorio'),
                        'address'                 => __('messages.alert.direccion_obligatoria'),
                        'zip_code'                => __('messages.alert.codigo_obligatorio'),
                        'cod_mpps'                => __('messages.alert.mpps_obligatorio'),
                    ];
                }

                $validator = Validator::make($request->all(), $rules, $msj);

                if ($validator->fails()) {
                    return response()->json([
                        'success' => 'false',
                        'errors'  => $validator->errors()->all()
                    ], 400);
                }

                // informacion del usuario
                $user = Auth::user();

                UtilsController::update_registro($user->id, $request);

                $action = '4';
                ActivityLogController::store_log($action);

                /**
                 * Acumulado para el manejo de estadisticas
                 * @param state
                 * @param 1 -> menor de edad
                 */
                EstadisticaController::accumulated_doctor($request->state);

                /**Preparamos el array que recibira la funcion para enviar la notificacion via WHATSAPP */
                $data = [
                    'phone' => preg_replace('/[\(\)\-\" "]+/', '', $request->phone),
                    'doctor' => $request->name . ' ' . $request->last_name,
                    'specialty' => $request->specialty,
                    'image' => 'https://system.sqlapio.com/img/notification_email/newsletter-header.png',
                ];

                ApiServicesController::whatsapp_register_doctor($data);

                return true;
            }

            if ($request->rol == 'laboratorio' || $request->rol == 'corporativo') {

                $rules = [
                    'rif'             => 'required',
                    'state'           => 'required',
                    'city'            => 'required',
                    'address'         => 'required',
                    'phone'           => 'required',
                    'license'         => 'required',
                    'type_laboratory' => 'required',
                    'responsible'     => 'required',
                ];

                $msj = [
                    'rif'             => __('messages.alert.rif_obligatorio'),
                    'state'           => __('messages.alert.estado_obligatorio'),
                    'city'            => __('messages.alert.ciudad_obligatorio'),
                    'address'         => __('messages.alert.direccion_obligatoria'),
                    'phone'           => __('messages.alert.telefono_obligatorio'),
                    'license'         => __('messages.alert.num_licencia_obligatorio'),
                    'type_laboratory' => __('messages.alert.tipo_lab_obligatorio'),
                    'responsible'     => __('messages.alert.responsable_obligatorio'),
                ];


                $validator = Validator::make($request->all(), $rules, $msj);

                if ($validator->fails()) {
                    return response()->json([
                        'success' => 'false',
                        'errors'  => $validator->errors()->all()
                    ], 400);
                }

                /**
                 * Capturamos la imagen del laboratorio si
                 * fue cargada por el usuario
                 */

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

                // informacion del usuario
                $laboratory = Auth::user();

                $patient = Laboratory::updateOrCreate(
                    ['id' => $request->id],
                    [

                        'code_lab'              => 'SQ-LAB-' . random_int(11111111, 99999999),
                        'user_id'               => $laboratory->id,
                        'business_name'         => $request->business_name,
                        'email'                 => $request->email,
                        'rif'                   => $request->rif,
                        'state'                 => $request->state,
                        'city'                  => $request->city,
                        'address'               => $request->address,
                        'phone_1'               => $request->phone,
                        'license'               => $request->license,
                        'type_laboratory'       => $request->type_laboratory,
                        'responsible'           => $request->responsible,
                        'descripcion'           => $request->descripcion,
                        'website'               => $request->website,
                        'lab_img'               => $nameFile

                    ]
                );

                $update = DB::table('users')
                    ->where('id', $laboratory->id)
                    ->update([
                        'status_register' => '2',
                    ]);

                $action = '17';
                ActivityLogController::store_log($action);

                return true;
            }
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            dd('Error Livewire.Components.Register.store()', $message);
        }
    }

    public function register_doctor_corporate($hash)
    {
        $corporate = User::where('center_id', Crypt::decryptString($hash))->first();
        $bellied_plan = null;
        $show = true;
        return view('livewire.components.register', compact('show', 'bellied_plan', 'corporate'));
    }

    public function render($id = null)
    {

        $bellied_plan = null;

        if ($id != null) {
            $type_plan = $id;
            // $bellied_plan = BilledPlan::where('id', decrypt($id))->first();
        }
        $show = true;
        return view('livewire.components.register', compact('show', 'bellied_plan', 'type_plan'));
    }
}
