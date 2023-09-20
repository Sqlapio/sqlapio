<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonPathologicalBackground extends Model
{
    use HasFactory;

    /**
     * Define table
     */
    protected $table = 'non_pathological_backgrounds';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'text',
    ];
}
