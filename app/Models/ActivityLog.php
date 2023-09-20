<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    /**
     * Define table
     */
    protected $table = 'activity_logs';

    /**
     * Datos de la tabla de logs
     *
     */
    protected $fillable = [
        'user',
        'user_email',
        'ip',
        'browser',
        'action',
    ];
}
