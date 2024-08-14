<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Patient;
use App\Models\Center;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicalRecord extends Model
{
    use HasFactory;

     /**
     * Define table
     */
    protected $table = 'medical_records';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'center_id',
        'patient_id',
        'record_code',
        'record_date',
        'record_type',
        'background',
        'razon',
        'diagnosis',
        // 'exams',
        'sintomas',
        'medications_supplements',
        'status_exam',
        'status_study',
    ];

    public function  get_paciente(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }

    public function  get_center(): HasOne
    {
        return $this->hasOne(Center::class, 'id', 'center_id');
    }

    public function  get_center_data(): HasOne
    {
        return $this->hasOne(DoctorCenter::class, 'center_id', 'center_id');
    }

    public function  get_doctor(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function  get_reference(): HasOne
    {
        return $this->hasOne(Reference::class, 'medical_record_id', 'id');
    }
    public function  get_study_medical(): HasMany
    {
        return $this->hasMany(StudyPatient::class, 'medical_record_id', 'id');
    }
     public function  get_exam_medical(): HasMany
    {
        return $this->hasMany(ExamPatient::class, 'medical_record_id', 'id');
    }

    public function  get_exam_medical_status_two(): HasMany
    {
        return $this->hasMany(ExamPatient::class, 'medical_record_id', 'id')->where('status','2');
    }

    public function  get_study_medical_status_two(): HasMany
    {
        return $this->hasMany(StudyPatient::class, 'medical_record_id', 'id')->where('status','2');
    }

    /**
     * Get all of the get_exams for the MedicalRecord
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function get_exams(): HasMany
    {
        return $this->hasMany(ExamPatient::class, 'medical_record_id', 'id');
    }

    /**
     * Get all of the get_exams for the MedicalRecord
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function get_studies(): HasMany
    {
        return $this->hasMany(StudyPatient::class,  'medical_record_id', 'id');
    }

    /**
     * Get all of the get_exams for the MedicalRecord
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function get_tratamientos(): HasMany
    {
        return $this->hasMany(Treatment::class,  'record_code', 'record_code');
    }

}
