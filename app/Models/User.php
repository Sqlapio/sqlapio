<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Define table
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        /**
         * Datos para el registro previo del usuario
         */
        'name',
        'last_name',
        'email',
        'password',
        'role',

        /**
         * Datos adicionales del usuario
         * para medicos y pacientes
         */
        'ci',
        'birthdate',
        'age',
        'genere',
        'phone',
        'state',
        'city',
        'address',
        'zip_code',

        /**
         * Datos adicionales del usuario tipo: Paciente
         * Nota: Al paciente se le cargaran las patologia
         * que padece o enfermedades cronicas al  momento
         * del registro en el sistema
         * @param Json
         */
        'pathologies',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
