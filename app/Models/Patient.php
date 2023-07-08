<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    /**
     * Define table
     */
    protected $table = 'patients';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [

        'name',
        'last_name',
        'ci',
        'email',
        'profession',
        'birthdate',
        'age',
        'genere',
        'phone',
        'state',
        'city',
        'address',
        'zip_code',
        'is_minor',
        're_name',
        're_last_name',
        're_ci',
        're_email',
        're_phone',

    ];
}
