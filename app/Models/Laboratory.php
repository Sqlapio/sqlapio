<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Laboratory extends Model
{
    use HasFactory;

     /**
     * Define table
     */
    protected $table = 'laboratories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code_lab',
        'user_id',
        'business_name',
        'rif',
        'email',
        'state',
        'city',
        'address',
        'phone_1',
        'lab_img',
        'license',
        'type_laboratory',
        'responsible',
        'descripcion',
        'website',
    ];

    public function  get_reference(): BelongsTo
    {
        return $this->belongsTo(Reference::class, 'laboratory_id', 'id');
    }

    public function  get_exams(): HasMany
    {
        return $this->hasMany(ExamPatient::class, 'laboratory_id', 'id');
    }

    public function  get_studies(): HasMany
    {
        return $this->hasMany(StudyPatient::class, 'laboratory_id', 'id');
    }

    /**
     * Get all of the comments for the Laboratory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function get_billed_plans(): HasMany
    {
        return $this->hasMany(BilledPlan::class, 'laboratory_id', 'id');
    }
}
 