<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

     /**
     * Define table
     */
    protected $table = 'exam_studies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'laboratory_id',
        'patient_id',
        'user_id',
        'center_id',
        'descripcion',
        'date',
    ];
    
}
