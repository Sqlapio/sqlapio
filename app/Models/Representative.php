<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Representative extends Model
{
    use HasFactory;

    /**
     * Define table
     */
    protected $table = 'representatives';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        /**
         * Datos para el representante cuando el paciente
         * es menor de edad.
         */
        're_name',
        're_ci',
        're_last_name',
        're_email',
        're_phone',
        'patient_id',
    ];

    /**
     * Pacientes asociados al representante
     */
    public function get_patients(): HasMany
    {
        return $this->hasMany(Representative::class, 'patient_id', 'id');
    }
}
