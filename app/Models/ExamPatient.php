<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ExamPatient extends Model
{
    use HasFactory;

     /**
     * Define table
     */
    protected $table = 'exam_patients';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'record_code',
        'cod_ref',
        'cod_exam',
        'description',
        'ref_id',
        'user_id',
        'center_id',
        'patient_id',
        'medical_record_id',
        'cod_medical_record',
        'date',
        'status',
        'cod_lab',
        'file',
        'date_result'
    ];

    public function get_user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function get_center(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'id', 'center_id');
    }

    public function get_patients(): HasOne
    {
        return $this->hasOne(Patient::class, 'id', 'patient_id');
    }

    public function get_reprensetative(): HasOne
    {
        return $this->hasOne(Representative::class, 'patient_id', 'patient_id');
    }

    public function  get_laboratory(): HasOne
    {
        return $this->hasOne(Laboratory::class, 'id', 'laboratory_id');
    }

    public function  get_reference(): HasOne
    {
        return $this->hasOne(Reference::class, 'id', 'ref_id');
    }

    /**
     * Get the medical_record that owns the ExamPatient
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function medical_record(): BelongsTo
    {
        return $this->belongsTo(MedicalRecord::class, 'medical_record_id', 'id');
    }
}
