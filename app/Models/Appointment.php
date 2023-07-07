<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    /**
     * Define table
     */
    protected $table = 'appointments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [

        'user_id',
        'patient_id',
        'center_id',
        'date_start',
        'hour_start',
        'hour_end',
        'type_appointments',
        'place_appointments',
        'price',

    ];
}
