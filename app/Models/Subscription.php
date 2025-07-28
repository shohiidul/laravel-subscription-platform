<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'status',
        'email_verify_token',
        'email_verified_at',
    ];    

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
        ];
    }  
}
