<?php

namespace App\Http\Livewire\Components;

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\ApiServicesController;
use App\Http\Controllers\EstadisticaController;
use App\Http\Controllers\HandleOtpController;
use App\Http\Controllers\UtilsController;
use App\Models\BilledPlan;
use App\Models\Center;
use App\Models\Laboratory;
use App\Models\State;
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

        if ($request->type_plan == "7") {
            $rules = [
                // 'business_name' => 'required',
                'password'      => 'required',
                'email'         => 'required|unique:users',
                // 'ci'            => 'required|unique:users',
            ];

            $msj = [
                // 'business_name'    => __('messages.alert.nombre_obligatorio'),
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
                'msj' => $validator->errors()->all()
            ], 400);
        }

        $date_today = Carbon::createFromFormat('Y-m-d', date('Y-m-d'));

        $date_today = $date_today->addDay(30)->format('Y-m-d');

        // valdiar otp y capchat
        // if (HandleOtpController::verify_otp($request) && UtilsController::validateCapchat($request)) {
        if (HandleOtpController::verify_otp($request)) {
            $business_name =null;
            $center_id =null;

            if ($request->id_center == null && $request->type_plan == "7") { //nuevo centro

                $business_name =$request->full_name ;

                $new_centers = new Center();
                $new_centers->address = $request->address;
                $new_centers->description = $request->full_name;
                $new_centers->state = $request->full_name;
                $new_centers->state_id = $request->state_contrie;
                $new_centers->country =$request->contrie;
                $new_centers->city_contrie = $request->city_contrie;
                $new_centers->color = UtilsController::color_dairy();
                $new_centers->corporate = true;
                $new_centers->save();

                $center_id = $new_centers->id;

            } else if($request->type_plan == "7" && $request->id_center != null ){

                $center = Center::where('id',$request->id_center)->first();
                $business_name = $center->description ;
                $center_id = $request->id_center;
            }

            $user = new User();
            $user->name = $request->name;
            $user->last_name = $request->last_name;
            $user->business_name = $business_name;
            $user->ci = $request->ci;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->verification_code = Str::random(30);
            $user->password = Hash::make($request->password);
            $user->email_verified_at = $date_today;

            if ($request->type_plan == '1' || $request->type_plan == 'corporate_medico') {

                $user->role = "medico";
            } elseif ($request->type_plan == '4') {
                $user->role = "laboratorio";
            } elseif ($request->type_plan == '7') {
                $user->role = "corporativo";
            } else {
                $user->role = "temporary";
            }

            // $user->master_corporate_id = ($request->type_plan == "corporate_medico") ? decrypt($user->id) : null;
            $user->type_plane = ($request->type_plan == "corporate_medico") ? '7' : $request->type_plan;
            $user->center_id = $center_id;
            $user->save();

            if ($request->type_plan == "7") {

                User::where("id", $user->id)->update([
                    "token_corporate" => env('APP_URL') . "/" . "register-user-corporate/" . encrypt($center_id)
                ]);
            } else {

                User::where("id", $user->id)->update([
                    "token_corporate" => env('APP_URL') . "/" . "registe-secretary/" . encrypt($user->id)
                ]);
            }

            // guardar datos en tabla laboratorios los datos de la corporativo
            if ($request->type_plan == "7") {
                if ($request->type_rif == '4') {
                    $type_rif = "F";
                }
                if ($request->type_rif == '5') {
                    $type_rif = "J";
                }
                if ($request->type_rif == '6') {
                    $type_rif = "C";
                }
                if ($request->type_rif == '7') {
                    $type_rif = "G";
                }

                $user_corporate = new Laboratory();
                $user_corporate->user_id = $user->id;
                $user_corporate->business_name =  $business_name;
                $user_corporate->rif =$type_rif . '-' . $request->ci;
                $user_corporate->email = $request->email;
                $user_corporate->save();

                /**Registro del usuario en stripe de forma directa. Usando la clase de Stripe */
                $stripeCustomer = $user->createAsStripeCustomer();

                /**Registro la accion del usuario registrado en el log */
                $action = 'corporate_plan';
                ActivityLogController::store_log($action);

                // /**Registro al accion de' Resgistro cliente STRIPE' en el log */
                $action = '25';
                ActivityLogController::store_log($action);
            } elseif ($request->type_plan == "corporate_medico") {

                User::where("id", $user->id)->update([
                    "center_id" => decrypt($request->coporate_id),
                    "master_corporate_id" =>User::where("center_id", decrypt($request->coporate_id))->where('role',"corporativo")->first()->id
                ]);
                # code...
                /**Registro la accion del usuario registrado en el log */
                $action = 'corporate_medico';
                ActivityLogController::store_log($action);
            } elseif ($request->type_plan == "1") {
                /**Registro del usuario en stripe de forma directa. Usando la clase de Stripe */
                $stripeCustomer = $user->createAsStripeCustomer();

                // /**Registro al accion de' Resgistro cliente STRIPE' en el log */
                $action = '3';
                ActivityLogController::store_log($action);
            } else {
                /**Registro del usuario en stripe de forma directa. Usando la clase de Stripe */
                $stripeCustomer = $user->createAsStripeCustomer();
                // /**Registro al accion de' Resgistro cliente STRIPE' en el log */
                $action = '25';
                ActivityLogController::store_log($action);
            }

            return response()->json([
                'success' => true,
                'msj'  => __('messages.alert.registro_inicial_sas')
            ], 200);
        } else {

            return response()->json([
                'success' => false,
                'msj'  => __('messages.alert.codigov_incorrecto')
            ], 400);
        }
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
                        'name'          => __('messages.alert.nombre_obligatorio'),
                        'last_name'     => __('messages.alert.apellido_obligatorio'),
                        'ci'            => __('messages.alert.cedula_obligatoria'),
                        'birthdate'     => __('messages.alert.fecha_obligatorio'),
                        'genere'        => __('messages.alert.genero_obligatorio'),
                        'specialty'     => __('messages.alert.especialidad_obligatorio'),
                        'age'           => __('messages.alert.edad_obligatorio'),
                        'phone'         => __('messages.alert.telefono_obligatorio'),
                        'state_contrie' => __('messages.alert.estado_obligatorio'),
                        'city_contrie'  => __('messages.alert.ciudad_obligatorio'),
                        'contrie'       => __('messages.alert.pais_obligatorio'),
                        'address'       => __('messages.alert.direccion_obligatoria'),
                        'zip_code'      => __('messages.alert.codigo_obligatorio'),
                        'cod_mpps'      => __('messages.alert.mpps_obligatorio'),
                    ];
                }

                $validator = Validator::make($request->all(), $rules, $msj);

                if ($validator->fails()) {
                    return response()->json([
                        'success' => 'false',
                        'errors' => $validator->errors()->all()
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
                        'errors' => $validator->errors()->all()
                    ], 400);
                }

                /**
                 * Capturamos la imagen del laboratorio si
                 * fue cargada por el usuario
                 */

                if (Str::contains($request->img, 'base64')) {
                    $file = $request->img;
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

                        'code_lab'        => 'SQ-LAB-' . random_int(11111111, 99999999),
                        'user_id'         => $laboratory->id,
                        'business_name'   => $request->business_name,
                        'email'           => $request->email,
                        'rif'             => $request->rif,
                        'state'           => $request->state,
                        'city'            => $request->city,
                        'address'         => $request->address,
                        'phone_1'         => $request->phone,
                        'license'         => $request->license,
                        'type_laboratory' => $request->type_laboratory,
                        'responsible'     => $request->responsible,
                        'descripcion'     => $request->descripcion,
                        'website'         => $request->website,
                        'lab_img'         => $nameFile

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
        $corporate = User::where('id', decrypt($hash))->first();
        $type_plan = "corporate_medico";
        return view('livewire.components.register', compact('corporate', 'type_plan', 'hash'));
    }

    public function render($id = null)
    {
        $bellied_plan = null;
        $centers = Center::all();

        if ($id != null) {
            $type_plan = $id;
            // $bellied_plan = BilledPlan::where('id', decrypt($id))->first();
        }

        return view('livewire.components.register', compact('type_plan', 'centers'));
    }
}
