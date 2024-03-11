<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemporaryEmailVerification extends Model
{
    use HasFactory;

     /**
     * Define table
     */
    protected $table = 'temporary_email_verification';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'code',
        'document_number',
        'status',
    ];
}
