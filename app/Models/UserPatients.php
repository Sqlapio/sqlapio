<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Cashier\Billable;
class UserPatients extends Authenticatable {
	use HasApiTokens, HasFactory, Notifiable;
	use Billable;

	protected $table = 'users_patients';

	protected $fillable = [
		'patient_id',
		'username',
		'password',
	];

	protected $hidden = [
		'password',
		'remember_token',
	];

	protected $casts = [
		'password' => 'hashed',
	];


	public function patients(): HasOne
    {
        return $this->hasOne(Patient::class, 'id', 'patient_id');
    }
}
