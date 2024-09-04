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

            /**
             * @param is_minor
             * ESTE IF() ES PARA PREGUNTAR SI EL PACIENTE ES MENOR DE EDAD
             */
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
                    // 'zip_code'      => 'required',

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
                    'genere'          => __('messages.alert.genero_obligatorio'),
                    'birthdate'       => __('messages.alert.fecha_obligatorio'),
                    'age'             => __('messages.alert.edad_obligatorio'),
                    'address'         => __('messages.alert.direccion_obligatoria'),
                    // 'zip_code'        => __('messages.alert.codigo_obligatorio'),
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
                if ( $request->center_id == null) {
                    $center_id_corporativo =  auth()->user()->master_corporate_id;

                }

                // Guardamos la informacion del paciente menor de edad

                $ci = str_replace('-', '', $request->re_ci);

                if (auth()->user()->role == "secretary" && auth()->user()->get_data_corporate_master->type_plane == "7") {

                    $dataCenter = auth()->user()->get_data_corporate_master;
                    $user_doc = $dataCenter->id;
                    $contrie_doc = $dataCenter->contrie;

                }

                if (auth()->user()->role == "secretary") {

                    $dataCenter = auth()->user()->get_data_corporate_master->get_doctors;
                    $contrie_doc = auth()->user()->get_data_corporate_master->contrie;
                    foreach($dataCenter as $item){
                        $user_doc = $item->user_id;
                    }
                }

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
                        'contrie_doc'       => auth()->user()->role == "secretary" ? $contrie_doc : auth()->user()->contrie,
                        'address'           => $request->address,
                        'email'             => $request->re_email,
                        'blood_type'        => $request->blood_type,
                        'ce_phone'          => $request->ce_phone,
                        'ce_name'           => $request->ce_name,
                        'relationship'      => $request->relationship,
                        'company'           => $request->company,
                        'validity'          => $request->validity,
                        'contact'           => $request->contact,
                        'seguro'            => $request->seguro,
                        'user_id'           => auth()->user()->role == "secretary" ? $user_doc : $user_id,
                        'center_id'         => isset($center_id_corporativo) ? $center_id_corporativo : $request->center_id,
                        'patient_img'       => $nameFile,
                        're_name'           => $request->re_name,
                        're_last_name'      => $request->re_last_name,
                        're_ci'             => $request->re_ci,
                        'verification_code' => Str::random(30)

                    ]
                );

                if($request->id != null)
                {
                    $action = '34';
                    ActivityLogController::store_log($action);
                }

                if($request->id == null){

                    $action = '9';
                    ActivityLogController::store_log($action);

                    /**Contador de pacientes*/
                    UtilsController::update_patient_counter($user_id);

                    /**estadistica de pacientes*/
                    EstadisticaController::accumulated_patient($user_id, $patient['center_id'], $request->state, $request->genere, 1);

                }

                /**Notificacion al Medico por haber registrado un paciente nuevo*/
                $user = Auth::user();
                if ($user->email_verified_at != null) {
                    $type = 'register_patient';
                    $mailData = [
                        'dr_name'       => $user->name . ' ' . $user->last_name,
                        'dr_email'      => $user->email,
                        'patient_name'  => $patient['name'] . ' ' . $patient['last_name'],
                        'patient_code'  => $patient['patient_code'],
                        'patient_email' => $patient['re_email'],
                        'patient_phone' => $patient['re_phone'],
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
                    $center_data = DoctorCenter::where('center_id', $request->center_id)->where('user_id', Auth::user()->id)->first();
                    $mailData = [
                        'dr_name'                => $user->name . ' ' . $user->last_name,
                        'specialty'              => $user->specialty,
                        'center'                 => $center_info->description,
                        'center_piso'            => $center_data->number_floor,
                        'center_consulting_room' => $center_data->number_consulting_room,
                        'center_phone'           => $center_data->phone_consulting_room,
                        'center_address'         => $center_data->address,
                        'patient_email'          => $user->email,
                        'patient_name'           => $patient['name'] . ' ' . $patient['last_name'],
                        'patient_code'           => $patient['patient_code'],
                        'patient_email'          => $patient['re_email'],
                        'patient_phone'          => $patient['re_phone'],
                    ];

                    /**Envia de Email al paciente registrado */
                    UtilsController::notification_mail($mailData, $type);

                    /**Notificacion por whatsapp */
                    ApiServicesController::whatsapp_register_patient($patient['re_phone'], $mailData);

                } else
                    /** Registro del medico con plan 1 2 o 3 */
                    {
                        $type = 'patient_minor';
                        // $center_info = DoctorCenter::where('center_id', $request->center_id)->where('user_id', Auth::user()->id)->first();

                        if (auth()->user()->role == "medico" && auth()->user()->type_plane == "7") {

                            $center_info = auth()->user();

                            /** cuando es una secretaria de un medico corporativo */
                        } elseif (auth()->user()->role == "secretary" && auth()->user()->get_data_corporate_master->type_plane == "7") {


                            $dataCenter = auth()->user()->get_data_corporate_master;

                            $numberFloor = $dataCenter->number_floor;
                            $nameDoctor = $dataCenter->name . ' ' . $dataCenter->last_name;
                            $numberConsultingRoom = $dataCenter->number_consulting_room;
                            $phoneConsultingRoom = $dataCenter->phone_consulting_room;
                            $center_address = $dataCenter->address;

                            /** cuando es una secretaria de un medico natural */
                        } elseif (auth()->user()->role == "secretary") {

                            $dataCenter = auth()->user()->get_data_corporate_master->get_doctors;

                            foreach($dataCenter as $item){
                                $nameDoctor = $item->name . ' ' . $item->last_name;
                                $numberFloor = $item->number_floor;
                                $numberConsultingRoom = $item->number_consulting_room;
                                $phoneConsultingRoom = $item->phone_consulting_room;
                                $center_address = $item->address;
                            }

                        } else {

                            // $data_center = DoctorCenter::where('user_id', $user->id)->where('center_id', $appointment->get_center->id)->first();
                            $center_info = DoctorCenter::where('center_id', $request->center_id)->where('user_id', Auth::user()->id)->first();

                        }

                        $mailData = [
                            'dr_name'                => auth()->user()->role == "secretary" ? $nameDoctor : $user->name . ' ' . $user->last_name,
                            'specialty'              => $user->specialty,
                            'center'                 => Center::where('id', $request->center_id)->first()->description,
                            'center_piso'            => auth()->user()->role == "secretary" ? $numberFloor : $center_info->number_floor,
                            'center_consulting_room' => auth()->user()->role == "secretary" ? $numberConsultingRoom : $center_info->number_consulting_room,
                            'center_phone'           => auth()->user()->role == "secretary" ? $phoneConsultingRoom : $center_info->phone_consulting_room,
                            'center_address'         => auth()->user()->role == "secretary" ? $center_address : $center_info->address,
                            'patient_email'          => $user->email,
                            'patient_name'           => $patient['name'] . ' ' . $patient['last_name'],
                            'patient_code'           => $patient['patient_code'],
                            'patient_email'          => $patient['re_email'],
                            'patient_phone'          => $patient['re_phone'],
                        ];

                        /**Envia de Email al paciente registrado */
                        UtilsController::notification_mail($mailData, $type);

                        /**Notificacion por whatsapp */
                        ApiServicesController::whatsapp_register_patient($patient['re_phone'], $mailData);
                    }

            } else {
                $user_name = $request->ci;
                $email = $request->email;
                /** Paciente mayor de edad */
                $rules = [

                    'name'          => 'required|min:3|max:50',
                    'last_name'     => 'required|min:3|max:50',
                    'ci'            => "required|min:5|max:15|unique:patients,ci,$request->id",
                    'email'         => "required|email",
                    // 'profession'    => 'required',
                    'genere'        => 'required',
                    'birthdate'     => 'required',
                    'age'           => 'required',
                    'address'       => 'required',
                    // 'zip_code'      => 'required',

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
                    'genere'            => __('messages.alert.genero_obligatorio'),
                    'birthdate'         => __('messages.alert.fecha_obligatorio'),
                    'age'               => __('messages.alert.edad_obligatorio'),
                    'estate'            => __('messages.alert.estado_obligatorio'),
                    'city'              => __('messages.alert.ciudad_obligatorio'),
                    'address'           => __('messages.alert.direccion_obligatoria'),
                    // 'zip_code'          => __('messages.alert.codigo_obligatorio'),
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

                if ($request->center_id == null) {
                    $center_id_corporativo =  auth()->user()->center_id;
                }

                /** Logica para cargar una nueva profesion */
                if (isset($request->profession_new)) {
                    $profession_new = Profession::create(['description' => $request->profession_new]);
                    $profession = $profession_new;
                } else {
                    $profession = $request->profession;
                }

                $ci = str_replace('-', '', $request->ci);

                if (auth()->user()->role == "secretary" && auth()->user()->get_data_corporate_master->type_plane == "7") {
                    $dataCenter = auth()->user()->get_data_corporate_master;
                    $user_doc = $dataCenter->id;
                    $contrie_doc = $dataCenter->contrie;

                }

                if (auth()->user()->role == "secretary") {
                    $dataCenter = auth()->user()->get_data_corporate_master->get_doctors;
                    $contrie_doc = auth()->user()->get_data_corporate_master->contrie;
                    foreach($dataCenter as $item){
                        $user_doc = $item->user_id;
                    }
                }

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
                        'contrie_doc'       => auth()->user()->role == "secretary" ? $contrie_doc : auth()->user()->contrie,
                        'state'             => $request->state,
                        'city'              => $request->city,
                        'address'           => $request->address,
                        'blood_type'        => $request->blood_type,
                        'ce_phone'          => $request->ce_phone,
                        'ce_name'           => $request->ce_name,
                        'ce_last_name'      => $request->ce_last_name,
                        'relationship'      => $request->relationship,
                        'company'           => $request->company,
                        'validity'          => $request->validity,
                        'contact'           => $request->contact,
                        'user_id'           => auth()->user()->role == "secretary" ? $user_doc : $user_id,
                        'center_id'         => isset($center_id_corporativo) ? $center_id_corporativo : $request->center_id,
                        'patient_img'       => $nameFile,
                        'verification_code' => Str::random(30)

                    ]
                );

                if($request->id != null)
                {
                    $action = '34';
                    ActivityLogController::store_log($action);

                    /**Contador de pacientes*/
                    UtilsController::update_patient_counter($user_id);
                }

                if($request->id == null){
                    $action = '9';
                    ActivityLogController::store_log($action);

                    /**Contador de pacientes*/
                    UtilsController::update_patient_counter($user_id);

                    /**estadistica de pacientes*/
                    EstadisticaController::accumulated_patient($user_id, $patient['center_id'], $request->state, $request->genere);
                }


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
                        'specialty'              => $user->specialty,
                        'center'                 => $center_info->description,
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
                } else
                /** Registro del medico con plan 1 2 o 3 */
                {

                    if (auth()->user()->role == "medico" && auth()->user()->type_plane == "7") {

                        $center_info = auth()->user();

                        /** cuando es una secretaria de un medico corporativo */
                    } elseif (auth()->user()->role == "secretary" && auth()->user()->get_data_corporate_master->type_plane == "7") {


                        $dataCenter = auth()->user()->get_data_corporate_master;

                        $numberFloor = $dataCenter->number_floor;
                        $nameDoctor = $dataCenter->name . ' ' . $dataCenter->last_name;
                        $numberConsultingRoom = $dataCenter->number_consulting_room;
                        $phoneConsultingRoom = $dataCenter->phone_consulting_room;
                        $center_address = $dataCenter->address;

                        /** cuando es una secretaria de un medico natural */
                    } elseif (auth()->user()->role == "secretary") {

                        $dataCenter = auth()->user()->get_data_corporate_master->get_doctors;

                        foreach($dataCenter as $item){
                            $nameDoctor = $item->name . ' ' . $item->last_name;
                            $numberFloor = $item->number_floor;
                            $numberConsultingRoom = $item->number_consulting_room;
                            $phoneConsultingRoom = $item->phone_consulting_room;
                            $center_address = $item->address;
                        }

                    } else {

                        // $data_center = DoctorCenter::where('user_id', $user->id)->where('center_id', $appointment->get_center->id)->first();
                        $center_info = DoctorCenter::where('center_id', $request->center_id)->where('user_id', Auth::user()->id)->first();

                    }

                    $type = 'patient';
                    $mailData = [
                        'dr_name'                => auth()->user()->role == "secretary" ? $nameDoctor : $user->name . ' ' . $user->last_name,
                        'specialty'              => $user->specialty,
                        'center'                 => Center::where('id', $request->center_id)->first()->description,
                        'center_piso'            => auth()->user()->role == "secretary" ? $numberFloor : $center_info->number_floor,
                        'center_consulting_room' => auth()->user()->role == "secretary" ? $numberConsultingRoom : $center_info->number_consulting_room,
                        'center_phone'           => auth()->user()->role == "secretary" ? $phoneConsultingRoom : $center_info->phone_consulting_room,
                        'center_address'         => auth()->user()->role == "secretary" ? $center_address : $center_info->address,
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
                    'patient_name'  => $patient['name'] . ' ' . $patient['last_name'],
                    'email'         => $email,
                    'password'      =>  $pass,
                    "title"         => "Contraseña establecida exitosamente"
                ];

                UtilsController::notification_mail($mailData, "recovery_pass_pat");

                /**Notificacion por whatsapp */
                ApiServicesController::whatsapp_portal_patiente($patient['phone'], $mailData);
            }

            $action = '5';
            ActivityLogController::store_log($action);

            /** Retorna el contador de pacientes registrador por el usuarios */
            $patient_counter = UtilsController::get_counter();
            $patient_counter = $patient_counter + 1;

            return [$patient, $patient_counter];

        } catch (\Throwable $th) {
            return response()->json([
                'success' => 'false',
                'errors'  => $th->getMessage()
            ], 500);
        }
    }

    public function render($id = null)
    {

        $patient = ($id) ? Patient::where('id', $id)->first() : [];

        $patients = UtilsController::get_table_medical_record(auth()->user()->id);
        $cities = UtilsController::get_cities();
        $states = UtilsController::get_states();
        $centers = DoctorCenter::where('user_id', Auth::user()->id)->where('status', 1)->get();
        $user = Auth::user();

        return view('livewire.components.patients', compact('patients', 'cities', 'states', 'centers', 'user', 'patient'));
    }
}
