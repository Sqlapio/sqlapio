<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    /**
     * Define table
     */
    protected $table = 'histories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [

        'patient_id',
        'cod_history',
        'cod_patient',
        'history_date',
        'weight',
        'height',
        'reason',
        'current_illness',
        'strain',
        'temperature',
        'breaths',
        'pulse',
        'saturation',
        'condition',
        'applied_studies',
        'info_add',
        'history_vital_signs',
        'back_family',
        'allergies',
        'history_non_pathological',
        'history_pathological',
        'history_surgical',
        'history_gynecological',
        'medications_supplements',

    ];
}
