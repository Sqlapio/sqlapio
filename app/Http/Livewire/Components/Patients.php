<?php

namespace App\Http\Livewire\Components;

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\ApiServicesController;
use App\Http\Controllers\EstadisticaController;
use App\Http\Controllers\UtilsController;
use App\Models\DoctorCenter;
use App\Models\Patient;
use App\Models\Representative;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;


class Patients extends Component
{

    use WithFileUploads;

    public function store(Request $request)
    {
        try {

            $user_id = Auth::user()->id;

            if(Str::contains($request->img, 'base64'))
            {
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

            }else{
                $nameFile = $request->img;
            }      
            
            if ($request->is_minor == "true") {
                $rules = [

                    'name'          => 'required|min:3|max:50',
                    'last_name'     => 'required|min:3|max:50',
                    're_name'       => 'required|min:3|max:50',
                    're_last_name'  => 'required|min:3|max:50',
                    're_email'      => 'required|email',
                    're_ci'         => 'required',
                    're_phone'      => 'required',
                    'birthdate'     => 'required',
                    'age'           => 'required|min:1|max:3',
                    'genere'        => 'required',
                    'state'         => 'required',
                    'city'          => 'required',
                    'address'       => 'required',
                    'zip_code'      => 'required',
                    // 'patient_img'   => 'image|max:1024',

                ];
                $msj =   [

                    'name'            => 'Campo requerido',
                    're_name'         => 'Campo requerido',
                    'name.min'        => 'Cantidad invalida de caracteres. Debe ser mayor de 3 caracteres',
                    'name.max'        => 'Cantidad invalida de caracteres. Debe ser menor de 50 caracteres',
                    're_name.min'     => 'Cantidad invalida de caracteres. Debe ser mayor de 3 caracteres',
                    're_name.max'     => 'Cantidad invalida de caracteres. Debe ser menor de 50 caracteres',
                    'last_name'       => 'Campo requerido',
                    're_last_name'    => 'Campo requerido',
                    're_ci'           => 'Campo requerido',
                    're_ci.min'       => 'Su cedula debe ser mayor a 5 caracteres',
                    're_ci.max'       => 'Su cedula invalida.',
                    're_email'        => 'Campo requerido',
                    're_email.unique' => 'El correo ya se encuentra registrado en el sistema',
                    'genere'          => 'Campo requerido',
                    'birthdate'       => 'Campo requerido',
                    'age'             => 'Campo requerido',
                    'age.min'         => 'Su edad debe ser un numero valido',
                    'age.max'         => 'Su edad es incorrecta',
                    'estate'          => 'Campo requerido',
                    'city'            => 'Campo requerido',
                    'address'         => 'Campo requerido',
                    'zip_code'        => 'Campo requerido',
                    'img.image'     => 'El archvio debe ser en formato png, jpg, jpeg',
                    // 'patient_img.max'       => 'La imagen debe ser menor a 1024',

                ];

                $validator = Validator::make($request->all(), $rules, $msj);

                if ($validator->fails()) {
                    return response()->json([
                        'success' => 'false',
                        'errors'  => $validator->errors()->all()
                    ], 400);
                }

                // Guardamos la informacion del paciente menor de edad

                $patient= Patient::updateOrCreate(['id' => $request->id],
                [

                    'patient_code'  => UtilsController::get_patient_code($request->re_ci),
                    'name'          => $request->name,
                    'last_name'     => $request->last_name,
                    'genere'        => $request->genere,
                    'birthdate'     => $request->birthdate,
                    'is_minor'      => 'true',
                    'age'           => $request->age,
                    'state'         => $request->state,
                    'city'          => $request->city,
                    'address'       => $request->address,
                    'zip_code'      => $request->zip_code,
                    'user_id'       => $user_id,
                    'center_id'     => $request->center_id,
                    'patient_img'   => $nameFile,
                    'verification_code' => Str::random(30)

                ]);

                /**
                 * Buscamos el ultimo paciente registrado por el medico
                 * @return $id
                 */
                $patient_id = Patient::where('user_id', $user_id)->get()->last()->id;

                $re_patient = new Representative();
                $re_patient->re_name = $request->re_name;
                $re_patient->re_last_name = $request->re_last_name;
                $re_patient->re_ci = $request->re_ci;
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

                /**
                 * Notificacion al paciente
                 */
                $type = 'p';
                $user = Auth::user();
                $mailData = [
                    'dr_name' => $user->name . ' ' . $user->last_name,
                    'dr_email' => $user->email,
					'patient_name' => $patient['name'] . ' ' . $patient['last_name'],
                    'patient_code' => $patient['patient_code'],
                    'patient_email' => $re_patient->re_email,
                    'patient_phone' => $re_patient->re_phone,
				];
                
                UtilsController::notification_mail($mailData, $type);

                /**
                 * Funcion para enviar el mensaje por whatsaap
                 * de bienvenida
                 */
                $caption = 'Bienvenido a sqlapio.com Sr(a). '.$request->name.' '.$request->last_name;
                $body = 'Paciente: '.$request->name.' '.$request->last_name.' Codigo:'.$patient['patient_code'];

                $image = 'http://sqldevelop.sqlapio.net/img/notification_email/cita_header.jpg';

                $phone = preg_replace('/[\(\)\-\" "]+/', '', $request->re_phone);
                
                ApiServicesController::sms_welcome($phone, $caption, $image);

                ApiServicesController::sms_info($phone, $body);


                // $doctor_email = Auth::user()->email;

                // if ($doctor_email != null) {
                //     $patient = Patient::where('id', $patient_id)->first();
                //     $name = $patient->name;
                //     $last_name = $patient->last_name;

                //     $title = 'Mail de SqlapioTechnology';
                //     $body = [
                //         'cuerpo' => 'Usted acaba de registrar al paciente: ' . $patient->name . ' ' . $patient->last_name,
                //         'name'  => $re_patient->re_name . ' ' . $re_patient->re_last_name,
                //         'ci'    => $re_patient->re_ci,
                //         'email' => $re_patient->re_email,
                //         'phone' => $re_patient->re_phone
                //     ];

                //     /**
                //      * Notificacion al paciente
                //      */
                //     $patient_name = $patient['name'].' '.$patient['last_name'];
                //     $patient_email = $request->re_email;

                //     UtilsController::notification_register_mail($patient['verification_code'], $patient_email, $patient_name, $type = 'p');

                // }


            } else {
                $rules =[

                        'name'          => 'required|min:3|max:50',
                        'last_name'     => 'required|min:3|max:50',
                        'ci'            => 'required|min:5|max:8',
                        'email'         => "required|email|unique:patients,email,$request->id",
                        'phone'         => 'required',
                        'profession'    => 'required',
                        'genere'        => 'required',
                        'birthdate'     => 'required',
                        'age'           => 'required|min:1|max:3',
                        'state'         => 'required',
                        'city'          => 'required',
                        'address'       => 'required',
                        'zip_code'      => 'required',

                    ];

                $msj = [

                    'name'         => 'Campo requerido',
                    'name.min'     => 'Cantidad invalida de caracteres. Debe ser mayor de 3 caracteres',
                    'name.max'     => 'Cantidad invalida de caracteres. Debe ser menor de 50 caracteres',
                    'last_name'    => 'Campo requerido',
                    'ci'           => 'Campo requerido',
                    'ci.min'       => 'Su cedula debe ser mayor a 5 caracteres',
                    'ci.max'       => 'Su cedula invalida.',
                    'email'        => 'Campo requerido',
                    'email.unique' => 'El correo ya se encuentra registrado en el sistema',
                    'profession'   => 'Campo requerido',
                    'genere'       => 'Campo requerido',
                    'birthdate'    => 'Campo requerido',
                    'age'          => 'Campo requerido',
                    'age.min'      => 'Su edad debe ser un numero valido',
                    'age.max'      => 'Su edad es incorrecta',
                    'estate'       => 'Campo requerido',
                    'city'         => 'Campo requerido',
                    'address'      => 'Campo requerido',
                    'zip_code'     => 'Campo requerido',
                    'patient_img.image'     => 'El archvio debe ser en formato png, jpg, jpeg',

                ];

                $validator = Validator::make($request->all(), $rules, $msj);

                if ($validator->fails()) {
                    return response()->json([
                        'success' => 'false',
                        'errors'  => $validator->errors()->all()
                    ], 400);
                }                                          
            

                $patient=  Patient::updateOrCreate(['id' => $request->id],
                [

                    'patient_code'  => UtilsController::get_patient_code($request->ci),            
                    'name'          => $request->name,
                    'last_name'     => $request->last_name,
                    'ci'            => $request->ci,
                    'email'         => $request->email,
                    'phone'         => $request->phone,
                    'profession'    => $request->profession,
                    'genere'        => $request->genere,
                    'birthdate'     => $request->birthdate,
                    'age'           => $request->age,
                    'state'         => $request->state,
                    'city'          => $request->city,
                    'address'       => $request->address,
                    'zip_code'      => $request->zip_code,
                    'user_id'       => $user_id,
                    'center_id'     => $request->center_id,
                    'patient_img'   => $nameFile,
                    'verification_code' => Str::random(30)

                ]);

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
                 * Notificacion al paciente
                 */
                $type = 'p';
                $user = Auth::user();
                $mailData = [
                    'dr_name' => $user->name . ' ' . $user->last_name,
                    'dr_email' => $user->email,
					'patient_name' => $patient['name'] . ' ' . $patient['last_name'],
                    'patient_code' => $patient['patient_code'],
                    'patient_email' => $patient['email'],
                    'patient_phone' => $patient['phone'],
				];
                
                UtilsController::notification_mail($mailData, $type);

                $caption = 'Bienvenido a sqlapio.com Sr(a). '.$request->name.' '.$request->last_name;
                $body = 'Paciente: '.$request->name.' '.$request->last_name.' Codigo:'.$patient['patient_code'];

                $image = 'http://sqldevelop.sqlapio.net/img/notification_email/cita_header.jpg';

                $phone = preg_replace('/[\(\)\-\" "]+/', '', $request->phone);

                ApiServicesController::sms_welcome($phone, $caption, $image);

                ApiServicesController::sms_info($phone, $body);

            }

            $action = '5';
            ActivityLogController::store_log($action);

            return $patient;
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            dd('Error Livewire.Components.Patient.store()', $message);
        }
    }

    public function search($ci)
    {
        try {

            $array = explode('-', $ci);
            
            if($array[1] == 'true'){
                $patient = Patient::where('ci', $array[0])->first();
                if($patient == null){
                    return response()->json([
                        'success' => 'false',
                        'errors'  => 'El paciente no existe debe registrarlo'
                    ], 400);
                }else{
                    return $patient;               
                }
            }else{
                $representative = Representative::where('re_ci', $array[0])->get();
                if($representative == null){
                    return response()->json([
                        'success' => 'false',
                        'errors'  => 'El paciente no existe debe registrarlo'
                    ], 400);
                }else{
                    foreach ($representative as $key => $value) {
                        $data_patient = Patient::where('id', $value->patient_id)->first();
                        $patient_re[$key] = [
                            'id' => $data_patient->id,
                            'is_minor' => $data_patient->is_minor,
                            'name_full' => $data_patient->name." ".$data_patient->last_name,
                            'patient_code' => $data_patient->patient_code,
                            'name' => $data_patient->name,
                            'last_name' => $data_patient->last_name, 
                            'email' => $data_patient->email, 
                            'profession' => $data_patient->profession, 
                            'age' => $data_patient->age,
                            'genere' => $data_patient->genere,
                            'birthdate' => $data_patient->birthdate,
                            'phone' => $data_patient->phone,
                            'state' => $data_patient->state,
                            'city' => $data_patient->city,
                            'address' => $data_patient->address,
                            'zip_code' => $data_patient->zip_code,
                            'patient_img' => $data_patient->patient_img,
                            'get_reprensetative' => [
                                're_name' => $value->re_name,
                                're_last_name' => $value->re_last_name,
                                're_ci' => $value->re_ci,
                                're_email' => $value->re_email,
                                're_phone' => $value->re_phone,
                            ],
                        ];
                    }
                    return $patient_re;
                }
                
            }
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            dd('Error Livewire.Components.Patient.search()', $message);
        }
    }
    public function render()
    {
        $patients = UtilsController::get_table_medical_record();
        $cities = UtilsController::get_cities();
        $states = UtilsController::get_states();
        $centers = DoctorCenter::where('user_id', Auth::user()->id)->where('status', 1)->get();
        return view('livewire.components.patients', compact('patients', 'cities', 'states', 'centers'));
    }
}
