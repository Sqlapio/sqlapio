<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Reference extends Model
{
    use HasFactory;

    /**
     * Define table
     */
    protected $table = 'references';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cod_ref', // => SQ-REF-12345678
        'user_id',
        'patient_id',
        'center_id',
        'cod_medical_record', //codigo de la consulta
        'date',
        'exams',
        'studies',
        'status_ref', //1- abierta  2- cerrada
        'laboratory_id',
        'cod_lab',
        'res_study',
        'res_exam',
        'medical_record_id'
    ];

    public function  get_patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }
    public function  get_center(): BelongsTo
    {
        return $this->belongsTo(Center::class, 'center_id', 'id');
    }

    public function get_laboratories(): HasMany
    {
        return $this->hasMany(Appointment::class, 'laboratory_id', 'id');
    }
    public function get_exam(): HasMany
    {
        return $this->hasMany(ExamPatient::class, 'ref_id', 'id');
    }
    public function get_studie(): HasMany
    {
        return $this->hasMany(StudyPatient::class, 'ref_id', 'id');
    }

    public function  get_center_data(): HasOne
    {
        return $this->hasOne(DoctorCenter::class, 'center_id', 'center_id');
    }

    public function  get_user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
