<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AiContainer extends Model
{
    use HasFactory;

     /**
     * Define table
     */
    protected $table = 'ai_containers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'symptoms',
        'responce_chatGPT',
    ];
}
