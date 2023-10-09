<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Patient;
use App\Models\Center;

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
        'exams',
        'studies',
        'medications_supplements',
        'status_exam',
        'status_study',
    ];

    public function  get_paciente(): HasOne
    {
        return $this->hasOne(Patient::class, 'id', 'patient_id');
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

}
