<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalSpeciality extends Model
{
    use HasFactory;

    /**
     * Define table
     */
    protected $table = 'medical_specialities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cod_specialty',
        'description',
    ];
}
