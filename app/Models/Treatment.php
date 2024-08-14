<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Treatment extends Model
{
    use HasFactory;

    /**
     * Define table
     */
    protected $table = 'treatments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'patient_id',
        'center_id',
        'record_code',
        'record_date',
        'date_treatments',
        'medicine',
        'indication',
        'treatmentDuration',
        'hours',
        'route',
    ];

    /**
     * Get the medical_record that owns the Treatment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function medical_record(): BelongsTo
    {
        return $this->belongsTo(MedicalRecord::class, 'record_code', 'record_code');
    }
}
