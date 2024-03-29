<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Center extends Model
{
    use HasFactory;

    /**
     * Define table
     */
    protected $table = 'centers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [

        'description',
        'state',
    ];

    public function get_interviews(): HasMany
    {
        return $this->hasMany(Interview::class, 'center_id', 'id');
    }

    public function get_patients(): HasMany
    {
        return $this->hasMany(Patient::class, 'patient_id', 'id');
    }

    public function get_doctors(): HasMany
    {
        return $this->hasMany(Patient::class, 'user_id', 'id');
    }

    public function get_references(): HasMany
    {
        return $this->hasMany(Patient::class, 'center_id', 'id');
    }

    public function get_exams(): HasMany
    {
        return $this->hasMany(Exam::class, 'center_id', 'id');
    }

    public function get_studies(): HasMany
    {
        return $this->hasMany(Study::class, 'center_id', 'id');
    }



}
