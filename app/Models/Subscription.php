<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\WebPortal;

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

    public function webPortal()
    {
        return $this->belongsTo(Subscription::class, 'portal_id', 'id');
    }  
}
