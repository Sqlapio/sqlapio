<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhysicalExam extends Model
{
    use HasFactory;

    /**
     * Define table
     */
    protected $table = 'physical_exams';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [

        'patient_id',
        'user_id',
        'center_id',
        'date',
        'weight',
        'height',
        'strain',
        'temperature',
        'breaths',
        'pulse',
        'saturation',
        'condition',
        'observations',

        //Signos vitales
        'hidratado',
        'eupenio',
        'febril',
        'esfera_neurologica',
        'glasgow',
        'esfera_orl',
        'esfera_cardiopulmonar',
        'esfera_abdominal',
        'extremidades',

    ];

    public function get_center()
    {
        return $this->hasOne(Center::class, 'id', 'center_id');
    }


}
