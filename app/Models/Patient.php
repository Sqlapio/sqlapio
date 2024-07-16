<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Representative;
use App\Models\MedicalRecord;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Patient extends Model
{
    use HasFactory;

    /**
     * Define table
     */
    protected $table = 'patients';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [

        'patient_code',
        'user_id',
        'center_id',
        'name',
        'last_name',
        'ci',
        'email',
        'email_verified_at',
        'profession',
        'birthdate',
        'age',
        'genere',
        'phone',
        'state',
        'city',
        'address',
        'zip_code',
        'is_minor',
        'patient_img',
        'verification_code',
        "contrie_doc",
        'blood_type',
        'ce_phone',
        'ce_name',
        'ce_last_name',
        'relationship',
        'company',
        'validity',
        'contact',

    ];

    public function  get_reprensetative(): HasOne
    {
        return $this->hasOne(Representative::class, 'patient_id', 'id');
    }

    public function  get_doctor(): HasOne
    {
        return $this->hasOne(User::class, 'user_id', 'id');
    }

    public function get_interview(): HasMany
    {
        return $this->hasMany(Interview::class, 'patient_id', 'id');
    }

    public function get_appointments(): HasMany
    {
        return $this->hasMany(Appointment::class, 'patient_id', 'id');
    }

    public function  get_history(): HasOne
    {
        return $this->hasOne(History::class, 'patient_id', 'id');
    }

    public function  get_medicard_record(): HasMany
    {
        return $this->HasMany(MedicalRecord::class, 'patient_id', 'id');
    }

    public function get_centers(): HasMany
    {
        return $this->hasMany(Center::class, 'patient_id', 'id');
    }

    public function get_center(): HasOne
    {
        return $this->hasOne(Center::class, 'id', 'center_id');
    }


    public function get_exams(): HasMany
    {
        return $this->hasMany(ExamPatient::class, 'patient_id', 'id');
    }

    public function get_studies(): HasMany
    {
        return $this->hasMany(StudyPatient::class, 'patient_id', 'id');
    }

    public function get_referencia(): HasMany
    {
        return $this->hasMany(Reference::class, 'patient_id', 'id');
    }

    /**
     * Get all of the medical_reports for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function medical_reports(): HasMany
    {
        return $this->hasMany(MedicalReport::class, 'patient_id', 'id');
    }

    public function get_patient_medical_record(): HasMany
    {
        return $this->hasMany(MedicalRecord::class, 'user_id', 'user_id');
    }

    /**
     * Get all of the get_physical_exams for the Patient
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function get_physical_exams(): HasMany
    {
        return $this->hasMany(PhysicalExam::class, 'patient_id', 'id');
    }

    /**
     * Get all of the treatment for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function treatment(): HasMany
    {
        return $this->hasMany(Treatment::class, 'id', 'patient_id');
    }
}
