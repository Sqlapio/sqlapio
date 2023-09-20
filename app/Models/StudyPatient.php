<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudyPatient extends Model
{
    use HasFactory;

     /**
     * Define table
     */
    protected $table = 'study_patients';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'record_code',
        'cod_ref',
        'cod_study',
        'description',
        'ref_id',
        'user_id',
        'center_id',
        'patient_id',
        'date',
        'status',
        'cod_lab',
        'file',
    ];

    public function get_user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function get_center(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'id', 'center_id');
    }

    public function get_patients(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'id', 'patient_id');
    }

    public function  get_laboratory(): BelongsTo
    {
        return $this->belongsTo(Laboratory::class, 'id', 'laboratory_id');
    }
}
