<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Center;

class DoctorCenter extends Model
{
    use HasFactory;

    /**
     * Define table
     */
    protected $table = 'doctor_centers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'address',
        'number_floor',
        'number_consulting_room',
        'phone_consulting_room',
        'user_id',
        'center_id',
        'status',

    ];

    public function get_center()
    {
        return $this->hasOne(Center::class, 'id', 'center_id');
    }
}
