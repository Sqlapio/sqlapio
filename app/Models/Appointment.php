<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'price',
        'color',
        'status',
        'code',
        'confirmation',

    ];

    public function get_patients(): HasOne
    {
        return $this->hasOne(Patient::class, 'id', 'patient_id');
    }

    public function get_center(): HasOne
    {
        return $this->hasOne(Center::class, 'id', 'center_id');
    }

    /**
     * Get all of the comments for the Appointment
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function get_status(): HasOne
    {
        return $this->hasOne(StatusDairy::class, 'id', 'status');
    }
}
