<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabPatient extends Model
{
    use HasFactory;

     /**
     * Define table
     */
    protected $table = 'lab_patients';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'laboratory_id',
        'patient_id',
        'reference_id',
        'cod_ref',

    ];
}
