<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    use HasFactory;

    /**
     * Define table
     */
    protected $table = 'interviews';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [

        'user_id',
        'patient_id',
        'center_id',
        'reason_visit',
        'physical_exam',
        'medication',
        'image_exam',
        'image_other',
    ];
}
