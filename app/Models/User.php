<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Http\Livewire\Components\Doctors;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Cashier\Billable;
class User extends Authenticatable {
	use HasApiTokens, HasFactory, Notifiable;
	use Billable;

	/**
	 * Define table
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		/**
		 * Datos para el registro previo del usuario
		 */
		'name',
		'business_name',
		'last_name',
		'email',
		'password',
		'verification_code',
		'email_verified_at',
		'role',
		'specialty',

		/**
		 * Datos adicionales del usuario
		 * para medicos y pacientes
		 */
		'ci',
		'birthdate',
		'age',
		'genere',
		'specialty',
		'phone',
		'state',
		'city',
		'address',
		'zip_code',

		/**
		 * @param status_register
		 * @value = 1 : registro inicial
		 * @value = 2 : registro completo
		 */
		'status_register',
		'user_img',
		'digital_cello',
		'digital_cello',
		'cod_mpps',

		/**
		 * Campos para conteo de acciones
		 * relacionadas a los planes
		 */
		'type_plane',
		'token',
		'patient_counter',
		'medical_record_counter',
		'ref_counter',
		'cod_update_email',
		'cod_update_pass',
        'date_end_plan',
        'expired_plan',
		'center_id',
		'master_corporate_id',
		"token_corporate"
	];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<int, string>
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'password' => 'hashed',
	];

	/**
     * Pacientes asociados al doctor.
     */
    public function patients(): HasMany
    {
        return $this->hasMany(Patient::class, 'patient_id', 'id');
    }

	/**
     * Consultas asociados al doctor.
     */
	public function get_interviews(): HasMany
    {
        return $this->hasMany(Interview::class, 'user_id', 'id');
    }

	/**
     * Centros asociados al doctor.
     */
	public function get_centers(): HasMany
    {
        return $this->hasMany(Center::class, 'user_id', 'id');
    }

	/**
     * Centros asociados al doctor.
     */
	public function get_references(): HasMany
    {
        return $this->hasMany(Reference::class, 'user_id', 'id');
    }

	public function get_laboratorio(): HasOne
    {
        return $this->HasOne(Laboratory::class, 'user_id', 'id');
    }

	public function get_exams(): HasMany
    {
        return $this->hasMany(Exam::class, 'user_id', 'id');
    }

    public function get_studies(): HasMany
    {
        return $this->hasMany(Study::class, 'user_id', 'id');
    }

	/**
	 * Get all of the get_plans for the User
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function get_billed_plans(): HasMany
	{
		return $this->hasMany(BilledPlan::class, 'user_id', 'id');
	}

	public function get_center(): HasOne
	{
		return $this->hasOne(Center::class, 'id', 'center_id');
	}

	public function get_data_corporate_master(): HasOne
	{
		return $this->hasOne(User::class, 'id', 'master_corporate_id');
	}

	public function get_state(): HasOne
	{
		return $this->hasOne(State::class, 'id', 'state');
	}

    /**
     * Get all of the medical_reports for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function medical_reports(): HasMany
    {
        return $this->hasMany(MedicalReport::class, 'user_id', 'id');
    }

    /**
     * Get all of the treatment for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function treatment(): HasMany
    {
        return $this->hasMany(Treatment::class, 'id', 'user_id');
    }

	
    public function get_doctors(): HasMany
    {
        return $this->hasMany(DoctorCenter::class, 'user_id', 'id');
    }

}
