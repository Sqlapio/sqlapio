<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


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

        'plan_id',
        'user_id',
        'laboratory_id',
        'type_plan',
        'methodo_payment',
        'name',
        'last_name',
        'number_id',
        'email',
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
        return $this->hasOne(User::class, 'user_id', 'id');
    }

    /**
     * Get the user associated with the BilledPlan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function get_laboratory(): HasOne
    {
        return $this->hasOne(User::class, 'laboratory_id', 'id');
    }

}
