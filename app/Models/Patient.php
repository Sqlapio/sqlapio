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

        'user_id',
        'center_id',
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

    ];
}
