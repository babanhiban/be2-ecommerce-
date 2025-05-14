<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerificationCode extends Model
{
    protected $fillable = [
        'email',
        'code',
        'type', // 'register' hoặc 'reset'
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];
}
