<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralStatistic extends Model
{
    use HasFactory;

    /**
     * Define table
     */
    protected $table = 'general_statistics';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'patient',
        'is_minor',
        'patient_genere',
        'user',
        'center',
        'date',
        'state',

    ];
}
