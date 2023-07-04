<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'user_id',
        'name',
        'last_name',
        'email',
        'birthdate',
        'age',
        'phone',
        'address',
    ];
}
