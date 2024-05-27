<?php

namespace App\Http\Livewire\Components;

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\ApiServicesController;
use App\Http\Controllers\EstadisticaController;
use App\Http\Controllers\UtilsController;
use App\Models\Center;
use App\Models\DoctorCenter;
use App\Models\Patient;
use App\Models\Profession;
use App\Models\Representative;
use App\Models\UserPatients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class Patients extends Component
{

    use WithFileUploads;

    public function store(Request $request)
    {

        try {
            $user_id = Auth::user()->id;
            $user_name = "";
            $email = '';

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

            if ($request->is_minor == "true") {

                $user_name = $request->re_ci;
                $email = $request->re_email;
                /** Paciente menor de edad */
                $rules = [

                    'name'          => 'required|min:3|max:50',
                    'last_name'     => 'required|min:3|max:50',
                    're_name'       => 'required|min:3|max:50',
                    're_last_name'  => 'required|min:3|max:50',
                    're_email'      => 'required|email',
                    're_ci'         => 'required',
                    're_phone'      => 'required',
                    'birthdate'     => 'required',
                    'age'           => 'required',
                    'genere'        => 'required',
                    'address'       => 'required',
                    'zip_code'      => 'required',

                ];
                $msj =   [

                    'name'            => __('messages.alert.nombre_obligatorio'),
                    're_name'         => __('messages.alert.nombre_obligatorio'),
                    'name.min'        => __('messages.alert.nombre_3_caracteres'),
                    'name.max'        => __('messages.alert.nombre_50_caracteres'),
                    're_name.min'     => __('messages.alert.nombre_3_caracteres'),
                    're_name.max'     => __('messages.alert.nombre_50_caracteres'),
                    'last_name'       => __('messages.alert.apellido_obligatorio'),
                    're_last_name'    => __('messages.alert.apellido_obligatorio'),
                    're_email'        => __('messages.alert.correo_obligatorio'),
                    're_email.unique' => __('messages.alert.correo_existente'),
                    'genere'          => __('messages.alert.genero_obligatorio'),
                    'birthdate'       => __('messages.alert.fecha_obligatorio'),
                    'age'             => __('messages.alert.edad_obligatorio'),
                    'address'         => __('messages.alert.direccion_obligatoria'),
                    'zip_code'        => __('messages.alert.codigo_obligatorio'),
                    'img.image'       => __('messages.alert.img_format'),

                ];

                $validator = Validator::make($request->all(), $rules, $msj);
                if ($validator->fails()) {
                    return response()->json([
                        'success' => 'false',
                        'errors'  => $validator->errors()->all()
                    ], 400);
                }

                /** Validacion para cargar el centro correcto cuando el medico
                 * esta asociado al plan corporativo
                 */
                if (Auth::user()->center_id != null) {
                    $center_id_corporativo = Auth::user()->center_id;
                }

                // Guardamos la informacion del paciente menor de edad

                $ci = str_replace('-', '', $request->re_ci);

                $patient = Patient::updateOrCreate(
                    ['id' => $request->id],
                    [

                        'patient_code'      => UtilsController::get_patient_code($request->re_ci),
                        'name'              => $request->name,
                        'last_name'         => $request->last_name,
                        'genere'            => $request->genere,
                        'birthdate'         => $request->birthdate,
                        'phone'             => $request->re_phone,
                        'is_minor'          => 'true',
                        'age'               => $request->age,
                        'contrie_doc'          => auth()->user()->contrie,
                        'address'           => $request->address,
                        'zip_code'          => $request->zip_code,
                        'user_id'           => $user_id,
                        'center_id'         => isset($center_id_corporativo) ? $center_id_corporativo : $request->center_id,
                        'patient_img'       => $nameFile,
                        'verification_code' => Str::random(30)

                    ]
                );

                /**
                 * Buscamos el ultimo paciente registrado por el medico
                 * @return $id
                 */
                $patient_id = Patient::where('user_id', $user_id)->get()->last()->id;

                $re_patient = new Representative();
                $re_patient->re_name = $request->re_name;
                $re_patient->re_last_name = $request->re_last_name;
                $re_patient->re_ci = $ci;
                $re_patient->re_email = $request->re_email;
                $re_patient->re_phone = $request->re_phone;
                $re_patient->patient_id = $patient_id;
                $re_patient->save();

                $action = '9';
                ActivityLogController::store_log($action);

                /**
                 * Acumulado para el manejo de estadisticas
                 * @param state
                 * @param 1 -> menor de edad
                 */
                EstadisticaController::accumulated_patient($request->state, $request->genere, 1);

                /**
                 * Logica para aumentar el contador
                 * de almacenamiento para el numero
                 * de pacientes.
                 *
                 * Esta logica se aplica al tema de los planes
                 */
                UtilsController::update_patient_counter($user_id);

                /**Notificacion al Medico por haber registrado un paciente nuevo*/
                $user = Auth::user();
                if ($user->email_verified_at != null) {
                    $type = 'register_patient';
                    $mailData = [
                        'dr_name'       => $user->name . ' ' . $user->last_name,
                        'dr_email'      => $user->email,
                        'patient_name'  => $patient['name'] . ' ' . $patient['last_name'],
                        'patient_code'  => $patient['patient_code'],
                        'patient_email' => $re_patient->re_email,
                        'patient_phone' => $re_patient->re_phone,
                    ];

                    UtilsController::notification_mail($mailData, $type);
                }


                /**
                 * Notificacion al paciente despues de haber sido registrador
                 * en nuestro sistema
                 */

                if (isset($center_id_corporativo)) {
                    /** Registro del medico con plan corporativo */
                    $type = 'patient_minor';
                    $center_info = Center::where('id', $center_id_corporativo)->first();
                    $mailData = [
                        'dr_name'                => $user->name . ' ' . $user->last_name,
                        'center'                 => $center_info->description,
                        'center_piso'            => 'prueba piso 1',
                        'center_consulting_room' => 'prueba consultorio 1',
                        'center_phone'           => 'prueba tef 02125478596',
                        'center_address'         => 'prueba dir chacao',
                        'patient_email'          => $user->email,
                        'patient_name'           => $patient['name'] . ' ' . $patient['last_name'],
                        'patient_code'           => $patient['patient_code'],
                        'patient_email'          => $re_patient->re_email,
                        'patient_phone'          => $re_patient->re_phone,
                    ];

                    /**Envia de Email al paciente registrado */
                    UtilsController::notification_mail($mailData, $type);

                    /**Notificacion por whatsapp */
                    ApiServicesController::whatsapp_register_patient($re_patient->re_phone, $mailData);

                } else
                    /** Registro del medico con plan 1 2 o 3 */
                    {
                        $type = 'patient_minor';
                        $center_info = DoctorCenter::where('center_id', $request->center_id)->where('user_id', Auth::user()->id)->first();
                        $mailData = [
                            'dr_name'                => $user->name . ' ' . $user->last_name,
                            'center'                 => Center::where('id', $request->center_id)->first()->description,
                            'center_piso'            => $center_info->number_floor,
                            'center_consulting_room' => $center_info->number_consulting_room,
                            'center_phone'           => $center_info->phone_consulting_room,
                            'center_address'         => $center_info->address,
                            'patient_email'          => $user->email,
                            'patient_name'           => $patient['name'] . ' ' . $patient['last_name'],
                            'patient_code'           => $patient['patient_code'],
                            'patient_email'          => $re_patient->re_email,
                            'patient_phone'          => $re_patient->re_phone,
                        ];

                        /**Envia de Email al paciente registrado */
                        UtilsController::notification_mail($mailData, $type);

                        /**Notificacion por whatsapp */
                        ApiServicesController::whatsapp_register_patient($re_patient->re_phone, $mailData);
                    }

            } else {
                $user_name = $request->ci;
                $email = $request->email;
                /** Paciente mayor de edad */
                $rules = [

                    'name'          => 'required|min:3|max:50',
                    'last_name'     => 'required|min:3|max:50',
                    'ci'            => "required|min:5|max:15|unique:patients,ci,$request->id",
                    'email'         => "required|email|unique:patients,email,$request->id",
                    'profession'    => 'required',
                    'genere'        => 'required',
                    'birthdate'     => 'required',
                    'age'           => 'required',
                    'address'       => 'required',
                    'zip_code'      => 'required',

                ];

                $msj = [

                    'name'              => __('messages.alert.nombre_obligatorio'),
                    'name.min'          => __('messages.alert.nombre_3_caracteres'),
                    'name.max'          => __('messages.alert.nombre_50_caracteres'),
                    'last_name'         => __('messages.alert.apellido_obligatorio'),
                    'ci'                => __('messages.alert.cedula_obligatoria'),
                    'ci.min'            => __('messages.alert.cedula_5_caracteres'),
                    'ci.max'            => __('messages.alert.cedula_8_caracteres'),
                    'ci.unique'         => __('messages.alert.cedula_existente'),
                    'email'             => __('messages.alert.correo_obligatorio'),
                    'email.unique'      => __('messages.alert.correo_existente'),
                    'profession'        => __('messages.alert.profesion_obligatoria'),
                    'genere'            => __('messages.alert.genero_obligatorio'),
                    'birthdate'         => __('messages.alert.fecha_obligatorio'),
                    'age'               => __('messages.alert.edad_obligatorio'),
                    'estate'            => __('messages.alert.estado_obligatorio'),
                    'city'              => __('messages.alert.ciudad_obligatorio'),
                    'address'           => __('messages.alert.direccion_obligatoria'),
                    'zip_code'          => __('messages.alert.codigo_obligatorio'),
                    'patient_img.image' => __('messages.alert.img_format'),

                ];

                $validator = Validator::make($request->all(), $rules, $msj);


                if ($validator->fails()) {
                    return response()->json([
                        'success' => 'false',
                        'errors'  => $validator->errors()->all()
                    ], 400);
                }

                /** Validacion para cargar el centro correcto cuando el medico
                 * esta asociado al plan corporativo
                 */
                if (Auth::user()->center_id != null) {
                    $center_id_corporativo = Auth::user()->center_id;
                }

                /** Logica para cargar una nueva profesion */
                if (isset($request->profession_new)) {
                    $profession_new = Profession::create(['description' => $request->profession_new]);
                    $profession = $profession_new;
                } else {
                    $profession = $request->profession;
                }

                $ci = str_replace('-', '', $request->ci);

                $patient =  Patient::updateOrCreate(
                    ['id' => $request->id],
                    [

                        'patient_code'      => UtilsController::get_patient_code($request->ci),
                        'name'              => $request->name,
                        'last_name'         => $request->last_name,
                        'ci'                => $ci,
                        'email'             => $request->email,
                        'phone'             => $request->phonenumber_prefix."-".$request->phone,
                        'profession'        => $profession,
                        'genere'            => $request->genere,
                        'birthdate'         => $request->birthdate,
                        'age'               => $request->age,
                        'contrie_doc'          => auth()->user()->contrie,
                        'state'             => $request->state,
                        'city'              => $request->city,
                        'address'           => $request->address,
                        'zip_code'          => $request->zip_code,
                        'user_id'           => $user_id,
                        'center_id'         => isset($center_id_corporativo) ? $center_id_corporativo : $request->center_id,
                        'patient_img'       => $nameFile,
                        'verification_code' => Str::random(30)

                    ]
                );

                /**
                 * Acumulado para el manejo de estadisticas
                 * @param state
                 */
                EstadisticaController::accumulated_patient($request->state, $request->genere);

                /**
                 * Logica para aumentar el contador
                 * de almacenamiento para el numero
                 * de pacientes.
                 *
                 * Esta logica se aplica al tema de los planes
                 */
                UtilsController::update_patient_counter($user_id);

                /**
                 * Notificacion al medico
                 */
                $user = Auth::user();
                if ($user->email_verified_at != null) {
                    $type = 'register_patient';
                    $mailData = [
                        'dr_name'       => $user->name . ' ' . $user->last_name,
                        'dr_email'      => $user->email,
                        'patient_name'  => $patient['name'] . ' ' . $patient['last_name'],
                        'patient_code'  => $patient['patient_code'],
                        'patient_email' => $patient['email'],
                        'patient_phone' => $patient['phone'],
                    ];

                    /**Envia de Email al paciente registrado */
                    UtilsController::notification_mail($mailData, $type);

                    /**Notificacion por whatsapp */
                    ApiServicesController::whatsapp_register_patient_doctor($patient['phone'], $mailData);
                }

                /**
                 * Notificacion al paciente
                 * por haber sido registrado
                 * en nuestro sistema
                 */
                if (isset($center_id_corporativo)) {
                    /** Registro del medico con plan corporativo */
                    $type = 'patient';
                    $center_info = Center::where('id', $center_id_corporativo)->first();
                    $mailData = [
                        'dr_name'                => $user->name . ' ' . $user->last_name,
                        'center'                 => $center_info->description,
                        'center_piso'            => 'prueba piso 1',
                        'center_consulting_room' => 'prueba consultorio 1',
                        'center_phone'           => 'prueba tef 02125478596',
                        'center_address'         => 'prueba dir chacao',
                        'patient_name'           => $patient['name'] . ' ' . $patient['last_name'],
                        'patient_code'           => $patient['patient_code'],
                        'patient_email'          => $patient['email'],
                        'patient_phone'          => $patient['phone'],
                    ];

                    /**Envia de Email al paciente registrado */
                    UtilsController::notification_mail($mailData, $type);

                    /**Notificacion por whatsapp */
                    ApiServicesController::whatsapp_register_patient($patient['phone'], $mailData);
                } else
                /** Registro del medico con plan 1 2 o 3 */
                {
                    $type = 'patient';
                    $center_info = DoctorCenter::where('center_id', $request->center_id)->where('user_id', Auth::user()->id)->first();
                    $mailData = [
                        'dr_name'                => $user->name . ' ' . $user->last_name,
                        'specialty'             => $user->specialty,
                        'center'                 => Center::where('id', $request->center_id)->first()->description,
                        'center_piso'            => $center_info->number_floor,
                        'center_consulting_room' => $center_info->number_consulting_room,
                        'center_phone'           => $center_info->phone_consulting_room,
                        'center_address'         => $center_info->address,
                        'patient_name'           => $patient['name'] . ' ' . $patient['last_name'],
                        'patient_code'           => $patient['patient_code'],
                        'patient_email'          => $patient['email'],
                        'patient_phone'          => $patient['phone'],
                    ];

                    /**Envia de Email al paciente registrado */
                    UtilsController::notification_mail($mailData, $type);

                    /**Notificacion por whatsapp */
                    ApiServicesController::whatsapp_register_patient($patient['phone'], $mailData);
                }

                $caption = 'Bienvenido a sqlapio.com Sr(a). ' . $request->name . ' ' . $request->last_name;
                $body = 'Paciente: ' . $request->name . ' ' . $request->last_name . ' Codigo:' . $patient['patient_code'];

                $image = 'http://sqldevelop.sqlapio.net/img/notification_email/cita_header.jpg';

                $phone = preg_replace('/[\(\)\-\" "]+/', '', $request->phone);

                // ApiServicesController::sms_welcome($phone, $caption, $image);

                // ApiServicesController::sms_info($phone, $body);
            }

            // registrar datos del pacientes en la table users_patients

            if (UserPatients::where("username", $user_name)->first() == null) {

                $pass = UtilsController::generete_pass($user_name);

                $UserPatients = new UserPatients();
                $UserPatients->username = $user_name;
                $UserPatients->patient_id = $patient->id;
                $UserPatients->password =  Hash::make($pass);
                $UserPatients->pass_tem =  $pass;
                $UserPatients->save();

                //enviar notificaion con el password
                $mailData = [
                    'email' => $email,
                    'password' =>  $pass,
                    "title" => "Contraseña establecida exitosamente"
                ];

                UtilsController::notification_mail($mailData, "recovery_pass_pat");
            }

            $action = '5';
            ActivityLogController::store_log($action);

            /** Retorna el contador de pacientes registrador por el usuarios */
            $patient_counter = UtilsController::get_counter();
            $patient_counter = $patient_counter + 1;

            return [$patient, $patient_counter];

        } catch (\Throwable $th) {
            $message = $th->getMessage();
            dd('Error Livewire.Components.Patient.store()', $message);
        }
    }

    public function search($ci)
    {

        $ci_maks = str_replace('-', '', $ci);

        try {

            $array = explode('-', $ci_maks);

            $ci_maks = $array[0];

            $tablePat =  Patient::where('ci', "=", $ci_maks);

            $tableRep =  Patient::whereHas('get_reprensetative', function ($q) use ($ci_maks) {
                $q->where('re_ci', "=", $ci_maks);
            });

            $patient = $tablePat->union($tableRep)->with('get_reprensetative')->get();

            if (count($patient) == 0) {
                return response()->json([
                    'success' => 'false',
                    'errors'  => __('messages.alert.paciente_no_registrado')
                ], 400);
            }

            return $patient;
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            dd('Error Livewire.Components.Patient.search()', $message);
        }
    }

    public function render($id = null)
    {

        $patient = ($id) ? Patient::where('id', $id)->first() : [];
        $patients = UtilsController::get_table_medical_record();
        $cities = UtilsController::get_cities();
        $states = UtilsController::get_states();
        $centers = DoctorCenter::where('user_id', Auth::user()->id)->where('status', 1)->get();
        $user = Auth::user();

        return view('livewire.components.patients', compact('patients', 'cities', 'states', 'centers', 'user', 'patient'));
    }
}
