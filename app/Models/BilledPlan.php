<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BilledPlan extends Model
{
    use HasFactory;

    /**
     * Define table
     */
    protected $table = 'billed_plans';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'laboratory_id',
        'type_plan',
        'methodo_payment',
        'number_card',
        'code_card',
        'amount',
        'date',
        'status'
    ];

    /**
     * Get the user associated with the BilledPlan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function get_user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * Get the user associated with the BilledPlan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function get_laboratory(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'laboratory_id');
    }

}
