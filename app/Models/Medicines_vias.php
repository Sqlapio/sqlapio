<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicines_vias extends Model
{
    use HasFactory;

     /**
     * Define table
     */
    protected $table = 'medicamentos_vias';

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
