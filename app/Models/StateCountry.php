<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StateCountry extends Model
{
    use HasFactory;

     /**
     * Define table
     */
    protected $table = 'states_contries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'country_id',
    ];
}
