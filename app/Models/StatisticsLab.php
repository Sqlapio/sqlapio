<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatisticsLab extends Model
{
    use HasFactory;

     /**
     * Define table
     */
    protected $table = 'statistics_labs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'study_id',
        'exam_id',
        'description',
        'category',
    ];
}
