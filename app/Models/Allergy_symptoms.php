<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allergy_symptoms extends Model
{
    use HasFactory;

     /**
     * Define table
     */
    protected $table = 'allergy_symptoms';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'description',
        'description_en',
    ];
}
