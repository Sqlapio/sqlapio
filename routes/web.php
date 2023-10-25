<?php

use App\Http\Controllers\PDFController;
use App\Http\Controllers\UtilsController;
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
use App\Http\Livewire\Components\Examen;
use App\Http\Livewire\Components\Laboratory;
use App\Http\Livewire\Components\Statistics;
use App\Http\Livewire\Components\Register;
use App\Http\Livewire\Components\Study;
use App\Models\Exam;
use App\Models\Patient;
use App\Models\Reference;
use App\Models\User as ModelsUser;

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

Route::get('/', [Login::class, 'render']);
Route::post('/login', [Login::class, 'login'])->name('login');
Route::get('/register-user', [Register::class, 'render'])->name('Register');
Route::post('/register', [Register::class, 'store'])->name('Register-create');
Route::get('/recovery-password', [RecoveryPassword::class, 'render'])->name('recovery_password');
Route::post('/create-password-temporary', [RecoveryPassword::class, 'create_password_temporary'])->name('create_password_temporary');
Route::post('/send-otp', [Profile::class, 'send_otp'])->name('send_otp_rp');
Route::post('/verify-otp', [Profile::class, 'verify_otp'])->name('verify_otp_rp');

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
 * Ruta para confirmacion
 * para la cita del PACIENTE
 */
Route::get('/confirmation/dairy/{code}', [UtilsController::class, 'confirmation_dairy']);
Route::get('/auth/setting/profile', [Profile::class, 'render'])->name('Profile')->middleware('auth');


Route::middleware(['auth','verify_email'])->group(function () {
    
    Route::group(array('prefix' => 'auth'), function () {
        Route::get('/home', [Home::class, 'render'])->name('home');
        Route::get('/dashboard', [DashboardComponent::class, 'render'])->name('DashboardComponent');
        Route::get('/patients', [Patients::class, 'render'])->name('Patients');
        Route::get('/setting', [setting::class, 'render'])->name('Setting');
        Route::get('/diary', [Diary::class, 'render'])->name('Diary');
        Route::post('/create-appointment', [Diary::class, 'store'])->name('CreateAppointment');
        Route::get('/clinical-history', [ClinicalHistory::class, 'render'])->name('ClinicalHistory');
        Route::get('/centers', [Centers::class, 'render'])->name('Centers');
        Route::post('/register-centers', [Centers::class, 'store'])->name('register-centers');
        Route::get('/statistics', [Statistics::class, 'render'])->name('Statistics');
        Route::get('/study', [Study::class, 'render'])->name('Study');
        Route::get('/examen', [Examen::class, 'render'])->name('Examen');

        Route::group(array('prefix' => 'patients'), function () {
            Route::get('/medical-record/{id}', [MedicalRecord::class, 'render'])->name('MedicalRecord');
            Route::post('/medical-consultation-create', [MedicalRecord::class, 'store'])->name('MedicalRecordCreate');
            Route::get('/medical-history', [MedicalHistory::class, 'render'])->name('MedicalHistory');
            Route::post('/register-patients', [Patients::class, 'store'])->name('register-patients');
            Route::get('/clinical-history/{id}', [ClinicalHistory::class, 'render'])->name('ClinicalHistoryDetail');
            Route::post('/clinical-history-create', [MedicalHistory::class, 'store'])->name('ClinicalHistoryCreate');
            Route::get('/search-patient/{value}', [Patients::class, 'search'])->name('search-patient');
            Route::get('/medicard_record_study/{id}', [Study::class, 'render'])->name("mr_study");
            Route::get('/medicard_record_exam/{id}', [Examen::class, 'render'])->name("mr_exam");
        });

        Route::group(array('prefix' => 'setting'), function () {
            Route::get('/user', [User::class, 'render'])->name('User');
            Route::post('/update-profile', [Register::class, 'update'])->name('update-profile');
            Route::get('/suscription', [Suscription::class, 'render'])->name('Suscription');
            Route::post('/send-otp', [Profile::class, 'send_otp'])->name('send_otp');
            Route::post('/verify-otp', [Profile::class, 'verify_otp'])->name('verify_otp');
            Route::post('/create-seal', [Profile::class, 'create_seal'])->name('create_seal');

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
     * Logout
     */
    Route::get('/logout', [Login::class, 'logout'])->name('logout');

    /**
     * @method PDF
     * @param id
     * Genera el pdf para las consultas de los pacientes
     */
    Route::get('/pdf/medical-record/{id}', [PDFController::class, 'PDF_medical_record'])->name('PDF_medical_record');

    /**
     * @method PDF
     * @param id
     * Genera el pdf para las historias
     */
    Route::get('/pdf/history/{id}', [PDFController::class, 'PDF_history'])->name('PDF_history');
    Route::get('/pdf/medical_prescription/{id}', [PDFController::class, 'PDF_medical_prescription'])->name('pdf_medical_prescription');


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

//route
Route::get('/pp', function () {
    $res = 'http://sqlapio.test/public/img/notification_email/cita_header.jpg';
    dd($res);
});
