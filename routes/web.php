<?php

use App\Http\Controllers\UtilsController;
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
use App\Http\Livewire\Components\Statistics;
use App\Http\Livewire\Components\Register;



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


Route::middleware(['auth'])->group(function () {
    
    Route::group(array('prefix' => 'auth'), function () {
        Route::get('/home', [Home::class, 'render'])->name('home');
        Route::get('/dashboard', [DashboardComponent::class, 'render'])->name('DashboardComponent');
        Route::get('/patients', [Patients::class, 'render'])->name('Patients');
        Route::get('/setting', [setting::class, 'render'])->name('Setting');
        Route::get('/diary', [Diary::class, 'render'])->name('Diary');
        Route::get('/clinical-history', [ClinicalHistory::class, 'render'])->name('ClinicalHistory');
        Route::get('/centers', [Centers::class, 'render'])->name('Centers');
        Route::get('/statistics', [Statistics::class, 'render'])->name('Statistics');

        Route::group(array('prefix' => 'patients'), function () {
            Route::get('/medical-record', [MedicalRecord::class, 'render'])->name('MedicalRecord');
            Route::get('/medical-history', [MedicalHistory::class, 'render'])->name('MedicalHistory');
            Route::post('/register-patients', [Patients::class, 'store'])->name('register-patients');
            Route::get('/clinical-history/{id}', [ClinicalHistory::class, 'render'])->name('ClinicalHistoryDetail');
            Route::post('/clinical-history-create', [MedicalHistory::class, 'store'])->name('ClinicalHistoryCreate');

        });

        Route::group(array('prefix' => 'setting'), function () {
            Route::get('/user', [User::class, 'render'])->name('User');
            Route::get('/profile', [Profile::class, 'render'])->name('Profile');
            Route::post('/update-profile', [Register::class, 'update'])->name('update-profile');
            Route::get('/suscription', [Suscription::class, 'render'])->name('Suscription');
        });
    });

    /**
     * @method EndPoint
     * lista de centros por medico
     */
    Route::get('/get_doctor_centers/{value}', [UtilsController::class, 'get_doctor_centers_pag'])->name('get_doctor_centers');

    /**
     * @method EndPoint
     * lista de Paciente con paginacion
     */
    Route::get('/get_patients/{value}', [UtilsController::class, 'get_patients_pag'])->name('get_patients_pagination');

    /**
     * Logout
     */
    Route::get('/logout', [Login::class, 'logout'])->name('logout');
});
