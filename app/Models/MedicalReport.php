<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalReport extends Model
{
    use HasFactory;

    use HasFactory;

     /**
     * Define table
     */
    protected $table = 'medical_reports';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cod_medical_report',
        'user_id',
        'center_id',
        'patient_id',
        'report'
    ];

}
