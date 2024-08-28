<?php

use App\Http\Controllers\ApiServicesController;
use App\Http\Controllers\HandleOtpController;
use App\Http\Controllers\MultilanguajeController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\UtilsController;
use App\Http\Livewire\Components\AdminPatients;
use App\Http\Livewire\Components\RecoveryPassword;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Components\Login;
use App\Http\Livewire\Components\Home;
use App\Http\Livewire\Components\DashboardComponent;
use App\Http\Livewire\Components\Patients;
use App\Http\Livewire\Components\MedicalHistory;
use App\Http\Livewire\Components\MedicalRecord;
use App\Http\Livewire\Components\Setting;
use App\Http\Livewire\Components\Profile;
use App\Http\Livewire\Components\User;
use App\Http\Livewire\Components\Suscription;
use App\Http\Livewire\Components\Diary;
use App\Http\Livewire\Components\ClinicalHistory;
use App\Http\Livewire\Components\Centers;
use App\Http\Livewire\Components\Dashboard;
use App\Http\Livewire\Components\Doctors;
use App\Http\Livewire\Components\Examen;
use App\Http\Livewire\Components\Laboratory;
use App\Http\Livewire\Components\PaymentForm;
use App\Http\Livewire\Components\Plan;
use App\Http\Livewire\Components\PlansVerify;
use App\Http\Livewire\Components\ProfilePatients\LoginPatient;
use App\Http\Livewire\Components\ProfilePatients\QueryDetalyPatient;
use App\Http\Livewire\Components\ProfilePatients\RecoveryPassword as ProfilePatientsRecoveryPassword;
use App\Http\Livewire\Components\ProfileSecretary\DashbordSecretary;
use App\Http\Livewire\Components\ProfileSecretary\Profile as ProfileSecretaryProfile;
use App\Http\Livewire\Components\ProfileSecretary\Registe as RegisteSecretary;

use App\Http\Livewire\Components\Statistics;
use App\Http\Livewire\Components\Register;
use App\Http\Livewire\Components\SalesForces\GeneralManager\Dashboard as GeneralManagerDashboard;
use App\Http\Livewire\Components\SalesForces\GeneralManager\Profile as GeneralManagerProfile;
use App\Http\Livewire\Components\SalesForces\GeneralZone\Dashboard as GeneralZoneDashboard;
use App\Http\Livewire\Components\SalesForces\GeneralZone\Profile as GeneralZoneProfile;
use App\Http\Livewire\Components\SalesForces\MedicalVisitor\Deshboard;
use App\Http\Livewire\Components\SalesForces\ProfileUser;
use App\Http\Livewire\Components\SalesForces\RegisterUserSalesForces;
use App\Http\Livewire\Components\Study;
use App\Http\Middleware\VerifyPlans;
use App\Http\Middleware\VerifyPlansActive;
use App\Models\Appointment;
use App\Models\Center;
use App\Models\Exam;
use App\Models\MedicalRecord as ModelsMedicalRecord;
use App\Models\Patient;
use App\Models\Reference;
use App\Models\Treatment;
use App\Models\User as ModelsUser;
use Illuminate\Support\Str;
use App\View\Components\VerifyplansComponent;
use Illuminate\Support\Facades\DB;
use App\Models\DoctorCenter;
use App\Models\ExamPatient;
use Illuminate\Support\Facades\Auth;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Spatie\LaravelPdf\Facades\Pdf;
use Spatie\LaravelPdf\Enums\Format;
use Spatie\Browsershot\Browsershot;
use \Spatie\LaravelPdf\Enums\Orientation;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [Login::class, 'render'])->name("Login_home");
Route::post('/login', [Login::class, 'login'])->name('login');
Route::get('/register-user/{id?}', [Register::class, 'render'])->name('Register');
Route::get('/register-user-corporate/{hash}', [Register::class, 'register_doctor_corporate'])->name('register_doctor_corporate');
Route::post('/register', [Register::class, 'store'])->name('Register-create');
Route::get('/recovery-password', [RecoveryPassword::class, 'render'])->name('recovery_password');
Route::post('/create-password-temporary', [RecoveryPassword::class, 'create_password_temporary'])->name('create_password_temporary');
Route::post('/send-otp', [Profile::class, 'send_otp'])->name('send_otp_rp');
Route::post('/verify-otp', [Profile::class, 'verify_otp'])->name('verify_otp_rp');
Route::post('/send_otp_global', [HandleOtpController::class, 'send_otp'])->name('send_otp_global');
Route::post('/verify_otp_global', [HandleOtpController::class, 'verify_otp'])->name('verify_otp_global');

//fuerzas de ventas
Route::get('/register-user-force-sale/{hash?}', [RegisterUserSalesForces::class, 'render'])->name('register_user_force_sale');
Route::post('/register_create_force_sale', [RegisterUserSalesForces::class, 'store'])->name('register_create_force_sale');

//prueba
Route::get('generate-pdf', [PDFController::class, 'generatePDF']);

/**
 * Ruta la verificacion de email
 * al realizar el registro del USUARIO/MEDICO
 * paciente/verify/{{ $verification_code }}
 */
Route::get('/verify/{verification_code}', [UtilsController::class, 'verify_email']);

/**
 * Ruta la verificacion de email
 * al realizar el registro del PACIENTE
 * paciente/verify/{{ $verification_code }}
 */
Route::get('/paciente/verify/{verification_code}', [UtilsController::class, 'patient_verify_email']);

/**
 * Ruta para confirmacion para la cita del PACIENTE
 */
Route::get('/confirmation/dairy/{code}', [UtilsController::class, 'confirmation_dairy']);

/**
 * Ruta para cancelar la cita del PACIENTE
 */
Route::get('/cancel/dairy/{code}', [UtilsController::class, 'cancelation_dairy']);

// planes
Route::post('/pay-plan-renew', [PaymentForm::class, 'pay_plan_renew'])->name("pay-plan-renew")->middleware(['auth', 'VerifySelloDigital', 'verify_email']);

Route::middleware(['auth', 'AuthCheck', 'VerifyPlansActive'])->group(function () {

    Route::group(array('prefix' => 'auth'), function () {
        Route::middleware(['VerifySelloDigital', 'verify_email'])->group(function () {
            Route::get('/home', [Home::class, 'render'])->name('home');
            Route::get('/dashboard', [DashboardComponent::class, 'render'])->name('DashboardComponent');
            Route::get('/dashboard/filter_month_dashboard/{month}', [UtilsController::class, 'filter_month_dashboard'])->name('filter_month_dashboard');
            Route::get('/patients/{id_patient?}', [Patients::class, 'render'])->name('Patients')->middleware(['VerifyPlanExpiredPlan']);
            Route::get('/setting', [setting::class, 'render'])->name('Setting');
            Route::get('/diary', [Diary::class, 'render'])->name('Diary');
            Route::post('/create-appointment', [Diary::class, 'store'])->name('CreateAppointment')->middleware(['VerifyPlanExpiredPlan']);
            Route::get('/clinical-history', [ClinicalHistory::class, 'render'])->name('ClinicalHistory');
            Route::get('/centers', [Centers::class, 'render'])->name('Centers');
            Route::post('/register-centers', [Centers::class, 'store'])->name('register-centers');
            Route::post('/dash/notifications/{code}', [ApiServicesController::class, 'whatsapp_send_dash'])->name('dash-notifications');
            Route::post('/register-new-centers', [Centers::class, 'regiter_center'])->name('register-new-centers');
            Route::post('/exam/{id}', [UtilsController::class, 'delete_file_exam'])->name('delete_file_exam');
            Route::post('/study/{id}', [UtilsController::class, 'delete_file_study'])->name('delete_file_study');
            Route::get('/statistics', [Statistics::class, 'render'])->name('Statistics');
            Route::get('/study', [Study::class, 'render'])->name('Study');
            Route::get('/examen', [Examen::class, 'render'])->name('Examen');

            Route::group(array('prefix' => 'patients'), function () {
                Route::get('/medical-record/{id}', [MedicalRecord::class, 'render'])->name('MedicalRecord')->middleware(['VerifyPlans']);
                Route::post('/medical-consultation-create', [MedicalRecord::class, 'store'])->name('MedicalRecordCreate')->middleware(['VerifyPlans']);
                Route::post('/create-informe-medico', [MedicalRecord::class, 'informe_medico'])->name('create-informe-medico')->middleware(['VerifyPlans']);
                Route::post('/create-examen-fisico', [MedicalRecord::class, 'store_physical_exams'])->name('create-examen-fisico')->middleware(['VerifyPlans']);
                Route::get('/medical-history', [MedicalHistory::class, 'render'])->name('MedicalHistory');
                Route::post('/register-patients', [Patients::class, 'store'])->name('register-patients');
                Route::get('/clinical-history/{id}', [ClinicalHistory::class, 'render'])->name('ClinicalHistoryDetail')->middleware(['VerifyPlans', 'VerifyPlanExpiredPlan']);
                Route::post('/clinical-history-create', [MedicalHistory::class, 'store'])->name('ClinicalHistoryCreate');
                Route::get('/search-patient/{value}', [Patients::class, 'search'])->name('search-patient');
                Route::get('/medicard_record_study/{id}', [Study::class, 'render'])->name("mr_study");
                Route::get('/medicard_record_exam/{id}', [Examen::class, 'render'])->name("mr_exam");
                Route::post('/medicard_record_ia', [UtilsController::class, 'sqlapio_ia'])->name("medicard_record_ia");
            });
        });

        ///
        Route::group(array('prefix' => 'setting'), function () {
            Route::get('/verify-plans', [PlansVerify::class, 'render'])->name('verify-plans');
            Route::get('/user', [User::class, 'render'])->name('User');
            Route::post('/update-profile', [Register::class, 'update'])->name('update-profile');
            Route::get('/suscription', [Suscription::class, 'render'])->name('Suscription');
            Route::post('/send-otp', [Profile::class, 'send_otp'])->name('send_otp')->middleware(['VerifySelloDigital', 'verify_email', 'VerifyPlans']);
            Route::post('/verify-otp', [Profile::class, 'verify_otp'])->name('verify_otp')->middleware(['VerifySelloDigital', 'verify_email', 'VerifyPlans']);
            Route::post('/create-seal', [Profile::class, 'create_seal'])->name('create_seal');
            Route::post('/create-background-pdf', [Profile::class, 'create_background_pdf'])->name('create_background_pdf');
            Route::get('/profile', [Profile::class, 'render'])->name('Profile');
            Route::get('/plan', [Plan::class, 'render'])->name('Plan');
            Route::get('/auth/setting/verify_plans', [PlansVerify::class, 'render'])->name('verify_plans');
            Route::get('/auth/setting/verify_plans', [PlansVerify::class, 'render'])->name('verify_plans');
        });


        // ruoter para ver examenes y estudios
        Route::get('/search_person/{value}/{row}', [UtilsController::class, 'search_person'])->name("search_person");
        Route::get('/search_studio/{value}/{row}', [UtilsController::class, 'search_studio'])->name("search_studio");

        /**
         * @method EndPoint
         * lista de centros por medico
         */
        Route::get('/get_patient_history/{id}', [UtilsController::class, 'get_patient_history'])->name('get_patient_history');

        /**
         * @method EndPoint
         * Habilitar centros
         */
        Route::get('/center_enabled/{id}', [Centers::class, 'centers_enabled'])->name('center_enabled');

        /**
         * @method EndPoint
         * deshabilitar centros
         */
        Route::get('/center_disabled/{id}', [Centers::class, 'centers_disabled'])->name('center_disabled');

        //grupos de rutas de corporativo
        Route::group(array('prefix' => 'corporate'), function () {
            Route::get('/dashboard_corporate', [Dashboard::class, 'render'])->name('Dashboard-corporate');
            Route::get('/doctors', [Doctors::class, 'render'])->name("doctors");
            Route::get('/admin-patients', [AdminPatients::class, 'render'])->name("admin_patients");
            Route::get('/get_patient_corporate', [UtilsController::class, 'get_patient_corporate'])->name("get_patient_corporate");
            Route::get('/get_medical_record_corporate', [UtilsController::class, 'get_medical_record_corporate'])->name("get_medical_record_corporate");
            Route::get('/get_doctor_corporate', [UtilsController::class, 'get_doctor_corporate'])->name("get_doctor_corporate");
            Route::get('/get_list_exam', [UtilsController::class, 'get_list_exam'])->name("get_list_exam");
            Route::get('/get_list_study', [UtilsController::class, 'get_list_study'])->name("get_list_study");
            Route::get('/enabled-doctor/{id}', [UtilsController::class, 'habilitar_doctor_corporate'])->name("enabled-doctor");
            Route::get('/disabled-doctor/{id}', [UtilsController::class, 'deshabilitar_doctor_corporate'])->name("disabled-doctor");
        });

        //grupos de rutas fuerzas de venta
        Route::group(array('prefix' => 'force-sale'), function () {
            Route::get('/dashboard/general-zone', [GeneralZoneDashboard::class, 'render'])->name('dashboard-general-zone');
            Route::get('/dashboard/general-manager', [GeneralManagerDashboard::class, 'render'])->name('dashboard-general-manager');
            Route::get('/dashboard/medical-visitor', [Deshboard::class, 'render'])->name('dashboard-medical-visitor');
            Route::group(array('prefix' => 'setting'), function () {
                Route::get('/profile', [ProfileUser::class, 'render'])->name('profile-user-force-sale');
                Route::post('/profile-update', [ProfileUser::class, 'updateProfile'])->name('update-profile-force-sale');
            });
        });
    });

    /**
     * @method EndPoint
     * lista de centros por medico
     */
    Route::get('/get_doctor_centers', [UtilsController::class, 'get_doctor_centers'])->name('get_doctor_centers');

    /**
     * @method EndPoint
     * lista de Paciente con paginacion
     */
    Route::get('/get_patients', [UtilsController::class, 'get_patients_pag'])->name('get_patients_pagination');

    /**
     * @method EndPoint
     * lista de consultas
     */
    Route::get('/get_medical_record/{id}', [UtilsController::class, 'get_medical_record_user'])->name('get_medical_record_user');



    /**
     * @method PDF
     * @param id
     * Genera el pdf para las consultas de los pacientes
     */
    Route::get('/pdf/medical-record/{id}', [PDFController::class, 'PDF_medical_record'])->name('PDF_medical_record');

    /**
     * @method PDF
     * @param id
     * Genera el pdf para las consultas de los pacientes
     */
    Route::get('/pdf/medical-prescription/{id}', [PDFController::class, 'PDF_medical_prescription'])->name('PDF_medical_prescription');


    /**
     * @method PDF
     * @param id
     * Genera el pdf para las historias
     */
    Route::get('/pdf/history/{id}', [PDFController::class, 'PDF_history'])->name('PDF_history');
    Route::get('/pdf/medical_prescription/{id}', [PDFController::class, 'PDF_medical_prescription'])->name('pdf_medical_prescription');
    /**
     * @method PDF
     * @param id
     * Genera el pdf para las consultas de los pacientes
     */
    Route::get('/pdf/informe_medico/{id}', [PDFController::class, 'PDF_informe_medico'])->name('PDF_informe_medico');

    /**
     * @method PDF
     * @param id
     * Genera el pdf para las consultas de los pacientes
     */
    Route::get('/pdf/exam/{id}', [PDFController::class, 'PDF_exam'])->name('PDF_exam');
    /**
     * @method PDF
     * @param id
     * Genera el pdf para las consultas de los pacientes
     */
    Route::get('/pdf/study/{id}', [PDFController::class, 'PDF_study'])->name('PDF_study');

    /**
     * @method search
     * @param value
     * Buscar paciente por cedula
     */
    Route::get('/search-patients/{value}', [Diary::class, 'search_patients'])->name("search_patients");

    /**
     * @method cancelled
     * @param value
     * cancelar cita del paciente
     */

    Route::get('/cancelled-appointments/{id}', [Diary::class, 'cancelled'])->name("cancelled_appointments");
    Route::get('/finalizar-appointments/{id}', [UtilsController::class, 'update_status_dairy'])->name("finalizar_appointments");

    /**
     * @method cancelled
     * @param value
     * actualizar cita del paciente
     */
    Route::put('/update-appointments', [Diary::class, 'update'])->name("update_appointments");
    /**
     * @method cancelled
     * @param value
     * cancelar cita del paciente
     */
    Route::get('/get_patient_boy_girl', [UtilsController::class, 'get_patient_boy_girl'])->name("get_patient_boy_girl");
    Route::get('/get_patient_teen', [UtilsController::class, 'get_patient_teen'])->name("get_patient_teen");
    Route::get('/get_patient_adult', [UtilsController::class, 'get_patient_adult'])->name("get_patient_adult");
    Route::get('/get_patient_elderly', [UtilsController::class, 'get_patient_elderly'])->name("get_patient_elderly");
    Route::get('/get_queries_month', [UtilsController::class, 'get_queries_month'])->name("get_queries_month");

    //grupos de rutas de laboratorio
    Route::group(array('prefix' => 'laboratoy'), function () {
        Route::post('/upload_result_exam', [UtilsController::class, 'upload_result_exam'])->name("upload_result_exam");
        Route::post('/upload_result_study', [UtilsController::class, 'upload_result_study'])->name("upload_result_study");
        Route::get('/get/reference', [UtilsController::class, 'get_all_ref'])->name("get_ref");



        // pdf referencia
        Route::get('/pdf/reference/{id}', [PDFController::class, 'PDF_ref'])->name("PDF_ref");

        // Referencias atendidas
        Route::get('/references/res', [UtilsController::class, 'responce_references'])->name("references_res");
    });
});

Route::post('/login-patient', [LoginPatient::class, 'login'])->name('login-patient');

Route::group(array('prefix' => 'public'), function () {
    Route::get('/payment-form/{type_plan?}/{token?}', [PaymentForm::class, 'render'])->name("payment-form");
    Route::post('/pay-plan', [PaymentForm::class, 'pay_plan'])->name("pay-plan");

    Route::group(array('prefix' => 'patient'), function () {
        Route::get('/recovery-pass', [ProfilePatientsRecoveryPassword::class, 'render'])->name('recovery-pass-pat');
        Route::post('/recovery-pass', [ProfilePatientsRecoveryPassword::class, 'handleRecoveryPass'])->name('handleRecoveryPass');

        Route::get('/query-detaly-patient', [QueryDetalyPatient::class, 'render'])->name("query-detaly-patient");
        Route::get('/search-detaly-patient/{id}', [QueryDetalyPatient::class, 'search_detaly'])->name("search-detaly-patient");
    });
});

Route::middleware(['auth'])->group(function () {

    //grupos de rutas rol secretaria
    Route::group(array('prefix' => 'secretary'), function () {

        Route::get('/profile-user-secretary', [ProfileSecretaryProfile::class, 'render'])->name("profile-user-secretary");
        Route::get('/dashbord-secretary', [DashbordSecretary::class, 'render'])->name("dashbord-secretary");
        Route::post('/dashbord-secretary', [ProfileSecretaryProfile::class, 'update'])->name("profile-secretary-update");
    });
});


/**
 * Logout
 */
Route::get('/logout', [Login::class, 'logout'])->name('logout');
Route::get('/logout-patient', [LoginPatient::class, 'logout'])->name('logout-patient');
Route::get('/res_exam', [Examen::class, 'res_exam'])->name('res_exam');
Route::get('/res_exam_sin_resul', [Examen::class, 'res_exam_sin_resul'])->name('res_exam_sin_resul');
Route::get('/res_study', [Study::class, 'res_study'])->name('res_study');
Route::get('/res_study_sin_resul', [Study::class, 'res_study_sin_resul'])->name('res_study_sin_resul');

Route::get('/reloadCapchat', [UtilsController::class, 'reloadCapchat'])->name('reloadCapchat');

Route::post('/validateCapchat', [UtilsController::class, 'validateCapchat'])->name('validateCapchat');


/**
 * Languaje
 */
Route::get('/lang/{lang}', [MultilanguajeController::class, 'lang'])->name('lang');

Route::get('/registe-secretary/{id?}', [RegisteSecretary::class, 'render'])->name('registe-secretary');
Route::post('/registe-secretary', [RegisteSecretary::class, 'store'])->name('registe-secretary');


Route::get('/prueba', function () {
    $MedicalRecord = ModelsMedicalRecord::where('id', 88)->with('get_paciente')->first();
    $pdf = public_path() . '/examenes/' . $MedicalRecord->get_paciente->ci . '_' . date('YmdHms') . '.pdf';
    $generator = new BarcodeGeneratorPNG();
    $doctor_center = DoctorCenter::where('user_id', $MedicalRecord->user_id)->where('center_id', $MedicalRecord->center_id)->first();
    $barcode = base64_encode($generator->getBarcode($MedicalRecord->get_paciente->patient_code, $generator::TYPE_CODE_128));
    $data = [
        'date' => date('m/d/Y'),
        'MedicalRecord' => $MedicalRecord,
        'barcode' => $barcode,

    ];
    return view('pdf.PDF_exam', [
        'data' => $data,
        'MedicalRecord' => $MedicalRecord,
        'barcode' => $barcode,
        'bg' => Auth::user()->background_pdf == '' ? 'white.png' : Auth::user()->background_pdf,
        'data_exam' => ExamPatient::where('record_code', $MedicalRecord->record_code)->get(),
    ]);
});

Route::get('/prueba2', function () {
    $medical_prescription = ModelsMedicalRecord::where('id', 55)->first();
    $doctor_center = DoctorCenter::where('user_id', $medical_prescription->user_id)->where('center_id', $medical_prescription->center_id)->first();
    $generator = new BarcodeGeneratorPNG();
    $barcode = base64_encode($generator->getBarcode('SQ-16007868-543', $generator::TYPE_CODE_128));
    $data = [
        'date' => date('m/d/Y'),
        'medical_prescription' => $medical_prescription,
        'barcode' => $barcode,
    ];
    return view("pdf.PDF_medical_prescription2", compact('medical_prescription', 'generator', 'barcode', 'data', 'doctor_center'));
});


Route::get('/tt', function () {
    return view("cancel");
});

Route::get('/t', function () {
    // try {

    //     $patients = Patient::all();

    //     foreach ($patients as $item) {

    //         /**Obtengo tdos los tratamientos diferentes que pueda tener el paciente */
    //         $treatmentReminder_patient = Treatment::where('patient_id', $item->id)
    //             ->where('send_status', 'activa')
    //             ->select([DB::raw("record_code as codigo")])
    //             ->groupBy('codigo')
    //             ->get()->pluck('codigo');
    //         dump($treatmentReminder_patient);
    //         /**
    //          * @param $treatmentReminder_patient
    //          * for() para recorrer el array de los codigos de consultas ya que el paciente
    //          * puede tener mas de una consulta y mas de un tratamiento.
    //          */
    //         for ($i = 0; $i < count($treatmentReminder_patient); $i++) {

    //             /**
    //              * @param array[]
    //              * Array vacio poara almacenar la cantidad dias de los tratamientos */
    //             $dias = [];

    //             /**
    //              * @param $treatmentReminder_patient[$i]
    //              * En la tabla de tratamientos pregunto los tratamiento asociados al codigo de la consulta
    //              */
    //             $treatment = Treatment::where('record_code', $treatmentReminder_patient[$i])
    //                 ->where('send_status', 'activa')->get()->toArray();

    //             /**
    //              * @param $treatment, $dias[], $medicine[], $indication[], $treatmentDuration[]
    //              *
    //              * 1.-> for() para calcular el numero de dias de cada tratamiento
    //              * y seleccionar el numero mayor, que sera el numero de veces
    //              * que se envie la notificacion.
    //              *
    //              * 2.-> Este for() tambien se utiliza para optener los diferentes tratamientos que
    //              * posee el paciente de acuerdo con el codigo de la consulta.
    //              */
    //             $medicine           = [];
    //             $indication         = [];
    //             $treatmentDuration  = [];

    //             for ($j = 0; $j < count($treatment); $j++) {

    //                 $cadena = $treatment[$j]['treatmentDuration'];

    //                 if (str_contains($cadena, 'dia') || str_contains($cadena, 'días')) {
    //                     $int_var = (int)filter_var($cadena, FILTER_SANITIZE_NUMBER_INT);
    //                     $total_dias = $int_var;
    //                 } elseif (str_contains($cadena, 'semana') || str_contains($cadena, 'semanas')) {
    //                     $int_var = (int)filter_var($cadena, FILTER_SANITIZE_NUMBER_INT);
    //                     $total_dias = $int_var * 7;
    //                 } elseif (str_contains($cadena, 'mes') || str_contains($cadena, 'meses')) {
    //                     $int_var = (int)filter_var($cadena, FILTER_SANITIZE_NUMBER_INT);
    //                     $total_dias = $int_var * 30;
    //                 } elseif (str_contains($cadena, 'año')) {
    //                     $int_var = (int)filter_var($cadena, FILTER_SANITIZE_NUMBER_INT);
    //                     $total_dias = $int_var * 365;
    //                 } else {
    //                     $total_dias = 0;
    //                 }

    //                 // array_push($dias, $total_dias);
    //                 $dias[$j] = $total_dias;
    //                 $medicine[$j] = $treatment[$j]['medicine'];
    //                 $indication[$j] = $treatment[$j]['indication'];
    //                 $treatmentDuration[$j] = $treatment[$j]['treatmentDuration'];
    //             }

    //             $doctor = ModelsUser::where('id', $item->user_id)->first();
    //             $patient_phone = Patient::where('id', $item->id)->first()->phone;

    //             $list_medicine = join(', ', $medicine);

    //             $caption = <<<EOF
    //                 *RECORDATORIO DE TRATAMIENTO:*

    //                 *RECORDATORIO DE TRATAMIENTO:*

    //                 *Se tomó su medicamento?. Recuerde que debe hacerlo...*

    //                 *Tratamiento Asignado por:*
    //                 *Doctor(a):* {$doctor->name} {$doctor->last_name}

    //                 *TRATAMIENTO*

    //                 *Medicamentos:*
    //                 {$list_medicine}
    //                 EOF;

    //             $params = array(
    //                 'token' => env('TOKEN_API_WHATSAPP'),
    //                 'to' => $patient_phone,
    //                 'image' => env('BANNER_SQLAPIO'),
    //                 'caption' => $caption
    //             );
    //             $curl = curl_init();
    //             curl_setopt_array($curl, array(
    //                 CURLOPT_URL => env('CURLOPT_URL_IMAGE'),
    //                 CURLOPT_RETURNTRANSFER => true,
    //                 CURLOPT_ENCODING => "",
    //                 CURLOPT_MAXREDIRS => 10,
    //                 CURLOPT_TIMEOUT => 30,
    //                 CURLOPT_SSL_VERIFYHOST => 0,
    //                 CURLOPT_SSL_VERIFYPEER => 0,
    //                 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //                 CURLOPT_CUSTOMREQUEST => "POST",
    //                 CURLOPT_POSTFIELDS => http_build_query($params),
    //                 CURLOPT_HTTPHEADER => array(
    //                     "content-type: application/x-www-form-urlencoded"
    //                 ),
    //             ));

    //             $response = curl_exec($curl);

    //             $err = curl_error($curl);

    //             curl_close($curl);

    //             /**
    //              * Este if() se encarga de actualizar el contador de envio de tratamientos
    //              * para evitar que al terminar el tiempo del tratamiento la notificacion
    //              * se siga enviando.
    //              */
    //             if (isset($response)) {
    //                 $update = Treatment::where('record_code', $treatmentReminder_patient[$i])->where('send_status', 'activa')->get();
    //                     foreach ($update as $key => $value)
    //                     {
    //                         $value->count_notifications_send = $value->count_notifications_send + 1;
    //                             if($value->count_notifications_send == max($dias))
    //                             {
    //                                 $value->send_status = 'inactiva';
    //                             }
    //                         $value->save();
    //                     }
    //             }else{
    //                 dd($err);
    //             }

    //         }

    //     }

    // } catch (\Throwable $th) {
    //     dd($th);
    // }
    dd( error_get_last());
});

///grupo de rutas pacientes modulo
Route::middleware(['authUserPatient'])->group(function () {
    Route::group(array('prefix' => 'public'), function () {
        Route::group(array('prefix' => 'patient'), function () {
            Route::get('/view-patient', [QueryDetalyPatient::class, 'toviewPatient'])->name("view-patient");
        });
    });
});
